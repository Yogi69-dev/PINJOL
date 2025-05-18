@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">
    <h3>Edit Profil</h3>

    @if (session('status'))
        <div class="alert alert-warning">
            Menunggu profil Anda akan disetujui Admin
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- method PUT untuk update --}}

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_card_number" class="form-label">Nomor KTP</label>
            <input type="text" name="id_card_number" value="{{ old('id_card_number', $user->id_card_number) }}" class="form-control" required>
        </div>

        {{-- Upload Dokumen --}}
        <div class="mb-3">
            <label for="ktp" class="form-label">Upload KTP</label>
            <input type="file" name="ktp" class="form-control" accept="image/*,application/pdf">
            @if ($user->ktp)
                <small>File saat ini: <a href="{{ asset('storage/' . $user->ktp) }}" target="_blank">Lihat KTP</a></small>
            @endif
        </div>

        <div class="mb-3">
            <label for="salary_slip" class="form-label">Slip Gaji / Bukti Penghasilan</label>
            <input type="file" name="salary_slip" class="form-control" accept="image/*,application/pdf">
            @if ($user->salary_slip)
                <small>File saat ini: <a href="{{ asset('storage/' . $user->salary_slip) }}" target="_blank">Lihat Slip Gaji</a></small>
            @endif
        </div>

        <div class="mb-3">
            <label for="selfie_ktp" class="form-label">Foto Selfie dengan KTP</label>
            <input type="file" name="selfie_ktp" class="form-control" accept="image/*">
            @if ($user->selfie_ktp)
                <small>File saat ini: <a href="{{ asset('storage/' . $user->selfie_ktp) }}" target="_blank">Lihat Foto Selfie</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
  