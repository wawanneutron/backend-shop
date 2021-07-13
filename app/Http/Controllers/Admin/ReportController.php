<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function cetak_pdf_product()
    {
        $data_product = Product::all();
        $pdf = PDF::loadView('admin.laporan.laporan-product', ['data' => $data_product]);
        return $pdf->download('data-product.pdf');
    }
    public function cetak_pdf_orders()
    {
        $data_orders = Invoice::where('status', 'success')->get();
        $total = Invoice::where('status', 'success')->sum('grand_total');
        $pdf = PDF::loadView('admin.laporan.laporan-orders', ['data' => $data_orders, 'grandTotal' => $total]);
        return $pdf->download('data-orders.pdf');
    }
}


//*note gunakan stream() untuk preview