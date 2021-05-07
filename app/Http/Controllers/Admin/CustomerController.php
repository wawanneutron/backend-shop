<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->when(request()->q, function ($customers) {
            $customers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.customer.index', compact('customers'));
    }
}