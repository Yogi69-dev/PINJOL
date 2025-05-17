@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card auth-card">
            <!-- Mengubah warna header menjadi hijau -->
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Login DOEKU</h4>
            </div>
            
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>

                    <div class="d-grid gap-2">
                        <!-- Mengubah warna tombol menjadi hijau -->
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>

                    <div class="mt-3 text-center">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
