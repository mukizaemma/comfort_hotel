<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'booking_id',
        'reservation_id',
        'payment_type',
        'amount',
        'payment_method',
        'payment_date',
        'notes',
        'status',
        'confirmed_by',
        'confirmed_at',
        'received_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'confirmed_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function confirmedBy(){
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function receivedBy(){
        return $this->belongsTo(User::class, 'received_by');
    }
}
