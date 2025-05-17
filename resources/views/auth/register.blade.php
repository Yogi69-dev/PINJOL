@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card auth-card">
            <!-- Header dengan warna hijau -->
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Daftar DOEKU</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email / Nomor Telepon -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email atau Nomor Telepon</label>
                        <input type="text" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control" required>
                    </div>

                    <!-- Tombol Daftar -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Daftar</button>
                    </div>

                    <!-- Link ke Login -->
                    <div class="mt-3 text-center">
                        Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
