@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🎛️ Dashboard Admin</h2>

    {{-- Info Admin --}}
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>
            Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda masuk sebagai <strong>Admin</strong>.
        </div>
        <div>
            <span class="badge bg-primary">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- Statistik Utama --}}
    <div class="row g-4 mb-4">
        <!-- Kartu 1: Total Pengguna -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">👥 Total Pengguna</h5>
                        <i class="fas fa-users fa-lg text-primary"></i>
                    </div>
                    <h3 class="card-text">{{ $totalUsers ?? 0 }}</h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Kartu 2: Total Pinjaman -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">💰 Total Pinjaman</h5>
                        <i class="fas fa-money-bill-wave fa-lg text-success"></i>
                    </div>
                    <h3 class="card-text">Rp {{ number_format($totalLoans ?? 0, 0, ',', '.') }}</h3>
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-outline-success mt-2">Kelola Pinjaman</a>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Pinjaman Belum Lunas -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">⏳ Belum Lunas</h5>
                        <i class="fas fa-clock fa-lg text-warning"></i>
                    </div>
                    <h3 class="card-text">{{ $unpaidLoans ?? 0 }}</h3>
                    <a href="{{ route('admin.loans.index', ['status' => 'unpaid']) }}" class="btn btn-sm btn-outline-warning mt-2">Cek Status</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Pengguna Terbaru --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📋 Pengguna Terdaftar Baru</h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUsers ?? [] as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->translatedFormat('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada pengguna terbaru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="card shadow">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📊 Aktivitas Terbaru</h5>
            <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse ($recentActivities ?? [] as $activity)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-{{ $activity->type_color ?? 'primary' }} me-2">{{ $activity->type ?? 'System' }}</span>
                        {{ $activity->description }}
                        @isset($activity->user)
                        <small class="text-muted">(oleh: {{ $activity->user->name }})</small>
                        @endisset
                    </div>
                    <span class="text-muted small">{{ $activity->created_at->diffForHumans() }}</span>
                </li>
                @empty
                <li class="list-group-item text-center text-muted py-3">Belum ada aktivitas terbaru</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection