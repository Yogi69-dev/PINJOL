<!-- resources/views/admin/loans/index.blade.php -->

@extends('layouts.app')

@section('title', 'Manajemen Pinjaman')

@section('content')
    <div class="container mt-4">
        <h2>📋 Manajemen Pinjaman</h2>

        <!-- Tabel Pinjaman -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <a href="{{ route('admin.loans.create') }}" class="btn btn-primary btn-sm">Tambah Pinjaman Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengguna</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->user->name }}</td>
                                    <td>Rp {{ number_format($loan->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($loan->status) }}</td>
                                    <td>
                                        <a href="{{ route('admin.loans.show', $loan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('admin.loans.edit', $loan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pinjaman ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div
