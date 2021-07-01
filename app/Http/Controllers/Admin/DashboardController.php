<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // count invoice
        $pending = Invoice::where('status', 'pending')->count();
        $success = Invoice::where('status', 'success')->count();
        $expired = Invoice::where('status', 'expired')->count();
        $failed = Invoice::where('status', 'failed')->count();

        // year and month
        $year  = date('Y');
        $month = date('m');
        $day   = date('d');
        // statistic revenue
        $revanueDay = Invoice::where('status', 'success')
            ->whereDay('created_at', '=',  $day)
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', $year)
            ->sum('grand_total');

        $revenueMonth = Invoice::where('status', 'success')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', $year)
            ->sum('grand_total');
        $revenueYear = Invoice::where('status', 'success')
            ->whereYear('created_at', $year)
            ->sum('grand_total');
        $revenueAll = Invoice::where('status', 'success')
            ->sum('grand_total');
        // pendapatan bulanan
        $revanueEveryMonth = DB::table('invoices')
            ->select(DB::raw("sum(grand_total) as revanue, date_format(created_at, '%Y-%m') as YearMonth"))
            ->where('status', 'success')
            ->groupBy('YearMonth')
            ->orderBy('YearMonth', 'ASC')
            ->get();

        $dataRevanues = array();
        foreach ($revanueEveryMonth as $key => $value) {
            array_push($dataRevanues, intval($value->revanue));
        }

        // product paling banyak dibeli ("terlaris")
        $data = Product::select('products.*', DB::raw('count(orders.product_id) as total'))
            ->join('orders', 'orders.product_id', '=', 'products.id')
            ->groupBy('orders.product_id')
            ->orderBy('total', 'DESC')
            ->take(4)
            ->get();

        return view('admin.dashboard.index', compact(
            'pending',
            'success',
            'expired',
            'failed',
            'revanueDay',
            'revenueMonth',
            'revenueYear',
            'revenueAll',
            'revanueEveryMonth',
            // 'dataRevanues'
            'dataRevanues'
        ));
    }
}
