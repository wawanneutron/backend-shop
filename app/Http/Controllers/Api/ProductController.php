<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAll()
    {
        $products = Product::latest()->get();

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Product',
            'product'   => $products
        ], 200);
    }

    public function productHome()
    {
        $products = Product::latest()->take(8)->get();

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Product',
            'product'   => $products
        ], 200);
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
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
}
