@extends('layouts.app-dashboard', [
    'title' => 'Orders'
])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class=" card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fas fa-shopping-cart mr-3"></i>Data Order</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.order.index') }}" method="get">
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <input type="text" name="q" class=" form-control" placeholder="Cari Berdasarkan No Invoice">
                                    <div class=" input-group-append">
                                        <button type="submit" class=" btn btn-primary text-uppercase"><i class="fas fa-search"></i> cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class=" table table-hover ">
                                <thead class=" table-primary text-uppercase text-center">
                                    <tr>
                                        <th style="width: 6%">No.</th>
                                        <th>No. Invoice</th>
                                        <th>Nama Lengkap</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $no => $invoice)
                                        <tr>
                                            <td>{{ ++$no + ($invoices->currentPage()-1) * ($invoices->perpage()) }}</td>
                                            <td>{{ $invoice->invoice }}</td>
                                            <td>{{ $invoice->name }}</td>
                                            <td>{{ $invoice->grand_total }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.order.show', $invoice->id) }}" class=" btn btn-primary"><i class="fa fa-list-ul"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            <p>Order Belum Tersedia !</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $invoices->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection