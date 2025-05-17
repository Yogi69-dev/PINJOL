@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <!-- Mengubah header card menjadi hijau -->
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">AYOK MEMINJAM</h4>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Lengkapi Profil & Verifikasi Identitas --}}
                <div class="card mb-4 border border-warning shadow-sm">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <i class="fas fa-id-card me-2"></i>
                        <h5 class="mb-0">Lengkapi Profil & Verifikasi Identitas</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            Agar kamu dapat <strong>mengajukan pinjaman</strong>, pastikan data profilmu sudah lengkap dan telah diverifikasi oleh sistem atau admin. Berikut langkah-langkahnya:
                        </p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <i class="fas fa-user me-2 text-success"></i>
                                Isi <strong>informasi pribadi</strong> seperti: nama lengkap, alamat, pekerjaan, dan penghasilan.
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-upload me-2 text-success"></i>
                                Upload dokumen penting:
                                <ul class="mb-0">
                                    <li>KTP</li>
                                    <li>Slip Gaji / Bukti Penghasilan</li>
                                    <li>Foto Selfie dengan KTP</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Tunggu proses <strong>verifikasi data</strong> oleh sistem atau admin.
                            </li>
                        </ul>

                        @if(auth()->user()->is_verified)
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-shield-check me-2"></i>
                                Data kamu sudah terverifikasi. Kamu bisa mengajukan pinjaman sekarang!
                            </div>
                        @else
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Data kamu belum lengkap atau belum terverifikasi.
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning">
                                <i class="fas fa-user-edit me-1"></i> Lengkapi Profil Sekarang
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Statistik Pinjaman --}}
                <div class="row text-center">
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="card h-100 border-success">
                            <div class="card-body">
                                <h5 class="card-title">Total Pinjaman</h5>
                                <p class="card-text display-6 fs-4">Rp {{ number_format($totalLoans ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="card h-100 border-success">
                            <div class="card-body">
                                <h5 class="card-title">Pinjaman Aktif</h5>
                                <p class="card-text display-6 fs-4">{{ $activeLoans ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="card h-100 border-success">
                            <div class="card-body">
                                <h5 class="card-title">Pengajuan Baru</h5>
                                <p class="card-text display-6 fs-4">{{ $pendingLoans ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabel Pinjaman Terakhir --}}
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Pinjaman Terakhir</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($loans) && $loans->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loans as $loan)
                                            <tr>
                                                <td>{{ $loan->id }}</td>
                                                <td>Rp {{ number_format($loan->amount, 0, ',', '.') }}</td>
                                                <td>{{ $loan->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ 
                                                        $loan->status === 'approved' ? 'success' : 
                                                        ($loan->status === 'rejected' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($loan->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-success">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Belum ada data pinjaman</p>
                        @endif
                    </div>
                </div>

                {{-- Tombol Ajukan Pinjaman --}}
                <div class="mt-4 text-end">
                    <a href="{{ route('loans.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Ajukan Pinjaman Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
