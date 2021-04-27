<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategory;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display data and search fitur in one code
        $categories = Category::latest()->when(request()->q,  function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // upload image
        $image = $request->file('image')->store('category-image', 'public');
        // save t DB
        $category = Category::create([
            'image' => $image,
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if ($category) {
            // redirect dengan pesan success
            return redirect()->route('admin.category.index')->with([
                'success' => 'Data Berhasil Disimpan!'
            ]);

            // redirect dengan pesan error
            return redirect()->route('admin.category.index')->with([
                'error' => 'Data Gagal Disimpan!'
            ]);
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        // check jika image kosong
        if ($request->file('image') == null) {
            // update data tanpa image
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
        } else {
            // hapus image lama
            Storage::delete('public/' . $category->image);

            // upload image baru
            $image = $request->file('image')->store('category-image', 'public');
            // save db
            $category->update([
                'image' => $image,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
        }

        if ($category) {
            // redirect dengan pesan success
            return redirect()->route('admin.category.index')->with([
                'success' => 'Data Berhasil Di Update'
            ]);
        } else {
            // redirect dengan pesan error
            return redirect()->route('admin.category.index')->with([
                'error' => 'Data Gagal Di Update'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $image = Storage::delete('public/' . $category->image);

        $category->delete();

        if ($category) {
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
