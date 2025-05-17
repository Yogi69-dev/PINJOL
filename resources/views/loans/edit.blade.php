@extends('layouts.app')

@section('title', 'Edit Pinjaman')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pinjaman</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('loans.update', $loan->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Jumlah Pinjaman (Rp)</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                       id="amount" name="amount" value="{{ old('amount', $loan->amount) }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Tenor (Bulan)</label>
                                <select class="form-select @error('duration') is-invalid @enderror"
                                        id="duration" name="duration" required>
                                    @foreach(range(1, 24) as $month)
                                        <option value="{{ $month }}" {{ old('duration', $loan->duration) == $month ? 'selected' : '' }}>
                                            {{ $month }} Bulan
                                        </option>
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
                                      id="purpose" name="purpose" rows="3" required>{{ old('purpose', $loan->purpose) }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('loans.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

