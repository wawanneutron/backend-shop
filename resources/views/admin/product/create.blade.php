@extends('layouts.app-dashboard',[
    'title' => 'Tambah Product'
])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-uppercase"><i class="fa fa-shopping-bag mr-3"></i>Tambah Product</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" id="image" class=" form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Nama Product</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class=" form-control @error('title') is-invalid @enderror" placeholder="masukan nama product">
                                @error('title')
                                    <div class="invalid-feedback">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category_id" class=" form-control">
                                            <option>-- PILIH KATEGORI --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">
                                            <p>{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Berat</label>
                                        <input type="number" name="weight" value="{{ old('weight') }}" class=" form-control @error('weight') is-invalid @enderror" placeholder="Berat Product (gram)">
                                         @error('weight')
                                            <div class="invalid-feedback">
                                            <p>{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Deskripsi</label>
                                <textarea name="content" id="content" class=" form-control content @error('content') is-invalid @enderror" placeholder="Deskripsi product">{{ old('content') }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>HARGA</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}" placeholder="Harga Produk">

                                        @error('price')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DISKON (%)</label>
                                        <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                            value="{{ old('discount') }}" placeholder="Diskon Produk (%)">

                                        @error('discount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                SIMPAN</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };
    
        tinymce.init(editor_config);
    </script>
@endsection