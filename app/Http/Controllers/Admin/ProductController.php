<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::latest()->when(request()->q, function ($products) {
        //     $products->where('title', 'like', '%' . request()->q . '%');
        // })->paginate(10);

        if (request()->ajax()) {
            $products = Product::with('category');
            return DataTables::of($products)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a class="btn btn-primary" href="' . route('admin.product.edit', $item->id) . '"><i class="fas fa-pencil-alt"></i></a>
                                <button onclick="Delete(this.id)" class=" btn btn-danger " id=" ' . $item->id . '">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                ';
                })
                ->addColumn('pic', function ($item) {
                    $url = asset("$item->image");
                    return '
                    <img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />;
                ';
                })
                ->rawColumns(['action', 'pic'])
                ->make();
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // handle upload gambar
        $image = $request->file('image')->store('product-image', 'public');
        // save database
        $product = Product::create([
            'image'         => $image,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'category_id'   => $request->category_id,
            'content'       => $request->content,
            'weight'        => $request->weight,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'discount'      => $request->discount,
        ]);

        if ($product) {
            return redirect()->route('admin.product.index')
                ->with(['success' => 'Data Product Berhasil Disimpan']);
        } else {
            return redirect()->route('admin.product.index')
                ->with(['error' => 'Data Product Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        // check jika gambar kosong

        if ($request->file('image') == null) {
            $product->update([
                'title'     => $request->title,
                'slug'      => Str::slug($request->title),
                'content'   => $request->content,
                'weight'    => $request->weight,
                'price'     => $request->price,
                'stock'     => $request->stock,
                'discount'  =>  $request->discount,
            ]);
        } else {
            // hapus image lama
            Storage::delete('public' . $product->image);
            // upload gambar yang baru
            $image = $request->file('image')->store('product-image', 'public');
            $product->update([
                'image'     => $image,
                'title'     => $request->title,
                'slug'      => Str::slug($request->title),
                'content'   => $request->content,
                'weight'    => $request->weight,
                'price'     => $request->price,
                'stock'     => $request->stock,
                'discount'  => $request->discount,
            ]);
        }
        return redirect()->route('admin.product.index')->with([
            'success' => 'Update Product Berhasil !'
        ]);
        return redirect()->route('admin.product.index')->with([
            'error' => 'Update Product Gagal !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = Storage::delete('public/' .  $product->image);

        $product->delete();

        if ($product) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
