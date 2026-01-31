<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'booking_id',
        'reservation_id',
        'invoice_type',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'subtotal',
        'tax',
        'discount',
        'total',
        'invoice_date',
        'due_date',
        'status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
