<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productAll()
    {
        $products = Product::with('gallery')->inRandomOrder()->paginate(12);

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Product',
            'product'   => $products,
        ], 200);
    }

    public function productHome()
    {
        // ambil 8 data secara random dan ditampilkan di home
        $products = Product::with('gallery')->inRandomOrder()->take(8)->get();

        // product paling banyak dibeli ("terlaris")
        $data = DB::table('products')
            ->select('products.*', DB::raw('count(orders.product_id) as total'))
            ->join('orders', 'orders.product_id', '=', 'products.id')
            ->join('invoices', 'invoices.id', '=', 'orders.invoice_id')
            ->where('invoices.status', 'success')
            ->groupBy('orders.product_id')
            ->orderBy('total', 'DESC')
            ->take(8)
            ->get();

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Product',
            'product'   => $products,
            'terlaris'  => $data
        ], 200);
    }


    public function show($slug)
    {
        $product = Product::with(['gallery', 'category'])->where('slug', $slug)->first();
        if ($product) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data Product' . $product->name,
                'product'   => $product
            ], 200);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Data Product Tidak Ditemukan !'
            ], 404);
        }
    }

    public function search($keyword)
    {
        $products = Product::with('gallery')
            ->where('title', 'LIKE', "%" . $keyword . "%")
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'success'   => true,
            'message'   => 'pencarian product',
            'product'   => $products,
        ], 200);
    }
}
