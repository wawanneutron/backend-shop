@extends('layouts.auth', [
    'title' => 'Forgot Password'
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-6 col-lg-4">
                <div class="img-logo text-center mt-5">
                    <img src="{{ asset('assets/img/company.png') }}" style=" width: 80px;">
                </div>
               <div class="card border-0 shadow-lg mb-3 mt-5">
                   <div class="card-body p-4">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5 class="text-center text-gray-900 mb-3">RESET PASSWORD</h5>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class=" font-weight-bold text-uppercase">Email Address</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class=" form-control @error('email') is-invalid @enderror" 
                                    value="{{ $request->email ?? old('email') }}"
                                    autocomplete="email"
                                    autofocus
                                    placeholder="Masukan Alamat Email">
                                    @error('email')
                                        <div class="alert alert-danger mt-2">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                            </div>
                            <button type="submit" class=" btn btn-danger mt-4 btn-block text-uppercase">Send password reset link</button>
                        </form>
                   </div>
               </div>
            </div>
        </div>
        <div class="text-center text-white">
            <label><a href="/login" class="text-dark">Kembali ke Login</a></label>
        </div>
    </div>
@endsection