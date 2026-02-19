<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table='rooms';

    protected $fillable = [
        'title',
        'slug',
        'room_number',
        'description',
        'image',
        'cover_image',
        'status',
        'room_status',
        'user_id',
        'category',
        'room_type',
        'price',
        'couplePrice',
        'max_occupancy',
        'bed_count',
        'bed_type',
        'amenity_id',
    ];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function images(){
        return $this->hasMany(Roomimage::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'assigned_room_id');
    }
}
