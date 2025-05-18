<!-- resources/views/admin/loans/show.blade.php -->

@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')
    <div class="container mt-4">
        <h2>🔍 Detail Pinjaman</h2>

        <!-- Kartu Detail Pinjaman -->
        <div class="card shadow mt-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Pinjaman</h5>
                <p><strong>Nama Pengguna:</strong> {{ $loan->user->name }}</p>
                <p><strong>Email:</strong> {{ $loan->user->email }}</p>
                <p><strong>Jumlah Pinjaman:</strong> Rp {{ number_format($loan->amount, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($loan->status) }}</p>
                <p><strong>Deskripsi:</strong> {{ $loan->description }}</p>
                <p><strong>Tanggal Pengajuan:</strong> {{ $loan->created_at->translatedFormat('d F Y') }}</p>
                <p><strong>Terakhir Diperbarui:</strong> {{ $loan->updated_at->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-4">
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">Kembali ke Daftar Pinjaman</a>
        </div>
    </div>
@endsection
