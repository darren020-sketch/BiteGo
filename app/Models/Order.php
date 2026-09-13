<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_LABELS = [
        'menunggu' => 'Menunggu',
        'dimasak' => 'Dimasak',
        'siap_ambil' => 'Siap Ambil',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    public const STATUS_NEXT = [
        'menunggu' => 'dimasak',
        'dimasak' => 'siap_ambil',
        'siap_ambil' => 'selesai',
    ];

    protected $fillable = [
        'order_number', 'user_id', 'stall_id', 'pickup_slot', 'pickup_code',
        'status', 'total_amount', 'total_qty', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getPickupSlotLabelAttribute(): string
    {
        return $this->pickup_slot === 'istirahat_2' ? 'Istirahat II' : 'Istirahat I';
    }

    public function getTotalAmountFormattedAttribute(): string
    {
        return 'Rp'.number_format($this->total_amount, 0, ',', '.');
    }
}
