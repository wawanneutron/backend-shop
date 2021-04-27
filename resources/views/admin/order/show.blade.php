@extends('layouts.app-dashboard', [
    'title' => 'Orders'
])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class=" card-header">
                        <h6 class="m6 font-weight-bold text-uppercase"><i class="fas fa-shopping-cart mr-3"></i>detail order</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td width="25%">
                                    No. Invoice
                                </td>
                                <td width="1%">:</td>
                                <td>{{ $invoice->invoice }}</td>
                            </tr>
                            <tr>
                                <td>No. Telp/WA</td>
                                <td>:</td>
                                <td>{{ $invoice->phone }}</td>
                            </tr>
                            <tr>
                                <td>Kurir/Service/Cost</td>
                                <td>:</td>
                                <td>{{ $invoice->courier }} / {{ $invoice->service }} / {{ moneyFormat($invoice->cost_courier) }}</td>
                            </tr>
                            <tr>
                                <td>Alamat lengkap</td>
                                <td>:</td>
                                <td>{{ $invoice->address }}</td>
                            </tr>
                            <tr>
                                <td>Total Pembelian</td>
                                <td>:</td>
                                <td>{{ moneyFormat($invoice->grand_total) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $invoice->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card border-0 rounded shadow mt-4">
                    <div class="card-body">
                        <h5><i class="fa fa-shopping-cart mr-3 text-uppercase"></i> Detail Order</h5>
                        <hr>
                        <table class=" table" style="border-style: solid !important;border-color: rgb(198, 206, 214) !important;">
                            <tbody>
                                @foreach ($invoice->orders()->get() as $product)
                                    <tr style="background: #edf2f7;">
                                        <td class="b-none" width="25%">
                                            <div class="wrapper-image-cart">
                                                <img src="{{ $product->image }}"  style="width: 100%;border-radius: .5rem">
                                            </div>
                                        </td>
                                        <td class="b-none text-right">
                                            <p class="m-0 font-weight-bold">{{ moneyFormat($product->price) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection