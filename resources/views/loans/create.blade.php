@extends('layouts.app')

@section('title', 'Ajukan Pinjaman Baru')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <!-- Mengubah header card menjadi hijau -->
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-hand-holding-usd me-2"></i>Form Pengajuan Pinjaman
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('loans.store') }}" id="loanForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Jumlah Pinjaman (Rp)</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Tenor (Bulan)</label>
                                <select class="form-select @error('duration') is-invalid @enderror" 
                                        id="duration" name="duration" required>
                                    @foreach(range(1, 24) as $month)
                                        <option value="{{ $month }}" {{ old('duration') == $month ? 'selected' : '' }}>{{ $month }} Bulan</option>
                                    @endforeach
                                </select>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="purpose" class="form-label">Tujuan Pinjaman</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" 
                                      id="purpose" name="purpose" rows="3" required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Simulasi Pembayaran --}}
                        <div class="card mb-4 border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-muted mb-3">
                                    <i class="fas fa-calculator me-2"></i>Simulasi Pembayaran
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1">Cicilan per Bulan:</p>
                                        <h4 id="monthlyPayment">Rp 0</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1">Total Pembayaran:</p>
                                        <h4 id="totalPayment">Rp 0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('loans.index') }}" class="btn btn-outline-success me-2">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane me-1"></i>Ajukan Pinjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const durationSelect = document.getElementById('duration');
    const monthlyPaymentDisplay = document.getElementById('monthlyPayment');
    const totalPaymentDisplay = document.getElementById('totalPayment');
    const interestRate = 0.02; // 2% per bulan

    function formatRupiah(amount) {
        return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
    }

    function calculatePayments() {
        const amount = parseFloat(amountInput.value) || 0;
        const duration = parseInt(durationSelect.value) || 1;

        if (amount > 0 && duration > 0) {
            const monthly = (amount * interestRate * Math.pow(1 + interestRate, duration)) / 
                            (Math.pow(1 + interestRate, duration) - 1);
            const total = monthly * duration;

            monthlyPaymentDisplay.textContent = formatRupiah(monthly);
            totalPaymentDisplay.textContent = formatRupiah(total);
        } else {
            monthlyPaymentDisplay.textContent = 'Rp 0';
            totalPaymentDisplay.textContent = 'Rp 0';
        }
    }

    amountInput.addEventListener('input', calculatePayments);
    durationSelect.addEventListener('change', calculatePayments);
    calculatePayments();
});
</script>
@endsection
