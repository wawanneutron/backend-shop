<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $customers = Customer::latest()->when(request()->q, function ($customers) {
        //     $customers->where('email', 'like', '%' . request()->q . '%');
        // })->paginate(10);

        if (request()->ajax()) {
            $customers = Customer::all();
            return DataTables::of($customers)->make();
        }

        return view('admin.customer.index');
    }
}
