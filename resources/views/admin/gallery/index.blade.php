@extends('layouts.app-dashboard', [
    'title' => 'gallery product'
])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fas fa-folder mr-3"></i>gallery product</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.gallery-product.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.gallery-product.create') }}" class="btn btn-primary btn-sm text-uppercase"
                                        style="padding-top: 10px;"><i class="fa fa-plus-circle mr-3"></i>tambah</a>
                                    </div>
                                    <input type="text" name="q" class=" form-control" placeholder="cari berdasarkan nama gallery product">
                                    <div class=" input-group-append">
                                        <button type="submit" class=" btn btn-primary text-uppercase"><i class="fa fa-search mr-2"></i>cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class=" table table-bordered text-center">
                                <thead>
                                    <tr class=" text-uppercase ">
                                        <th style="width: 6%">No.</th>
                                        <th style="width: 40%">Image</th>
                                        <th>Nama Product</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($galleries as $no => $gallery)
                                        <tr>
                                            <td>{{ ++$no + ($galleries->currentPage()-1) * $galleries->perPage() }}</td>
                                            <td>
                                                <img src="{{ $gallery->image }}" style="width: 50px">
                                            </td>
                                            <td>{{ $gallery->productGallery->title }}</td>
                                            <td>
                                                <a href="{{ route('admin.gallery-product.edit', $gallery->productGallery->id) }}" class=" btn btn-primary btn-sm"><i class="fa fa-pencil-alt "></i></a>
                                                <button onclick="Delete(this.id)" class="btn btn-sm btn-danger"
                                                id="{{ $gallery->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                           <p> Data Belum Tersedia !</p>
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $galleries->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
        //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("admin.gallery-product.index") }}/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function () {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@endsection