<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tampilkan order terbaru "latest" dan buat pengkondisian "when"
        $invoices = Invoice::latest()->when(request()->q, function ($invoices) {
            $invoices->where('invoice', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.show', compact('invoice'));
    }
}
