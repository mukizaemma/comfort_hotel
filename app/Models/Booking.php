<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
        protected $table='bookings';

    protected $fillable = [
        'names',
        'phone',
        'email',
        'checkin',
        'checkout',
        'checkin_date',
        'checkout_date',
        'adults',
        'children',
        'others',
        'rooms',
        'message',
        'admin_reply',
        'admin_replied_at',
        'status',
        'room_id',
        'facility_id',
        'reservation_type',
        'assigned_room_id',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'payment_status',
        'booking_type',
        'checked_in_by',
        'checked_out_by',
        'checked_in_at',
        'checked_out_at',
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'checkout_date' => 'date',
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function facility(){
        return $this->belongsTo(\App\Models\Facility::class, 'facility_id');
    }

    public function assignedRoom(){
        return $this->belongsTo(Room::class, 'assigned_room_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function checkedInBy(){
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    public function checkedOutBy(){
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    public function roomMovements(){
        return $this->hasMany(RoomMovement::class);
    }
}
