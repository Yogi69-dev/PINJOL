<!-- resources/views/admin/loans/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Pinjaman')

@section('content')
    <div class="container mt-4">
        <h2>✏️ Edit Pinjaman</h2>

        <!-- Form Edit Pinjaman -->
        <div class="card shadow mt-4">
            <div class="card-body">
                <form action="{{ route('admin.loans.update', $loan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pengguna</label>
                        <select id="user_id" name="user_id" class="form-select" required>
                            <option value="">Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $loan->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pinjaman</label>
                        <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $loan->amount) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="pending" {{ $loan->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved" {{ $loan->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ $loan->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $loan->description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui Pinjaman</button>
                </form>
            </div>
        </div>
    </div>
@endsection

