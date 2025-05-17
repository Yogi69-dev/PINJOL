<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Status pembayaran
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    // Tipe pembayaran
    const TYPE_INSTALLMENT = 'installment';
    const TYPE_EARLY_REPAYMENT = 'early_repayment';

    protected $fillable = [
        'loan_id',
        'user_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'transaction_reference',
        'notes',
        'type',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Relasi dengan Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // Relasi dengan User (yang melakukan pembayaran)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk pembayaran yang sukses
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    // Scope untuk cicilan biasa
    public function scopeInstallments($query)
    {
        return $query->where('type', self::TYPE_INSTALLMENT);
    }
}