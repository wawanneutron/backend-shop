@extends('layouts.app-dashboard', [
    'title' => 'Data Customers'
])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fas fa-users mr-3"></i>Data Customers</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.customer.index') }}" method="get">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class=" form-control" placeholder="Cari nama customer">
                                    <div class=" input-group-append">
                                        <button type="submit" class=" btn btn-primary text-uppercase" ><i class="fas fa-search mr-2"></i>cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class=" table-responsive">
                            <table class=" table table-bordered">
                                <thead>
                                    <tr class=" text-center">
                                        <th width="6%">No</th>
                                        <th>Nama Customer</th>
                                        <th>Email Customer</th>
                                        <th>Tanggal Bergabung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $no => $customer)
                                        <tr>
                                            <td>{{ ++$no + ($customer->currentPage()-1) * $customer->perPage() }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ dateID($customer->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            <p>Data Tidak Ada !</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class=" text-center">
                                {{ $customers->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection