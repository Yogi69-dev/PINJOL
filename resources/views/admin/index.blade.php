@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if ($user->is_admin)
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada pengguna</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
