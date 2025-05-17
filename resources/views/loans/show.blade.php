@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <!-- Mengubah header card menjadi hijau -->
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Detail Pinjaman #{{ $loan->id }}
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Pinjaman</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Jumlah Pinjaman</span>
                                    <strong>Rp {{ number_format($loan->amount, 0, ',', '.') }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tenor</span>
                                    <strong>{{ $loan->duration }} Bulan</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Bunga per Bulan</span>
                                    <strong>{{ $loan->interest_rate * 100 }}%</strong>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-4">
                                    <span class="badge bg-{{ 
                                        $loan->status === 'approved' ? 'success' : 
                                        ($loan->status === 'rejected' ? 'danger' : 'warning') 
                                    }} fs-6 p-3">
                                        {{ ucfirst($loan->status) }}
                                    </span>
                                    <p class="mt-3 mb-0">
                                        <small class="text-muted">
                                            Diajukan pada: {{ $loan->created_at->translatedFormat('d F Y H:i') }}
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Tujuan Pinjaman</h6>
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <p class="mb-0">{{ $loan->purpose }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted d-flex justify-content-between align-items-center">
                            <span>Rencana Pembayaran</span>
                            <span class="badge bg-info">
                                Total: Rp {{ number_format($loan->monthly_payment * $loan->duration, 0, ',', '.') }}
                            </span>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cicilan ke</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= $loan->duration; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $loan->created_at->addMonths($i)->translatedFormat('d F Y') }}</td>
                                        <td>Rp {{ number_format($loan->monthly_payment, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-secondary">Belum Dibayar</span>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('loans.index') }}" class="btn btn-outline-success me-md-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        @if($loan->status === 'pending')
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-success">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
