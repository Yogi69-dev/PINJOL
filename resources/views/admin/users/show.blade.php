@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">👤 Detail Pengguna</h2>

    <div class="card">
        <div class="card-header">
            <h5>Informasi Pengguna</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Peran:</strong> {{ ucfirst($user->role) }}</li>
                <li class="list-group-item"><strong>Terdaftar Sejak:</strong> {{ $user->created_at->translatedFormat('d F Y') }}</li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
