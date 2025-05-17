<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // Status pinjaman
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'interest_rate',
        'monthly_payment',
        'purpose',
        'status',
        'approved_at',
        'completed_at',
        'admin_notes',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
        'amount' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'interest_rate' => 'decimal:2',
    ];

    // Relasi dengan User (pemilik pinjaman)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Payment (satu pinjaman bisa memiliki banyak pembayaran)
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Scope untuk pinjaman yang sedang berjalan
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    // Hitung sisa pinjaman
    public function getRemainingAmountAttribute()
    {
        $paid = $this->payments()->sum('amount');
        return $this->amount - $paid;
    }

    // Cek apakah pinjaman sudah lunas
    public function isPaidOff()
    {
        return $this->remaining_amount <= 0;
    }
}