@extends('layouts.app-dashboard', [
    'title' => 'Kategori'
])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fas fa-folder mr-3"></i>kategori</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm text-uppercase"
                                        style="padding-top: 10px;"><i class="fa fa-plus-circle mr-3"></i>tambah</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection