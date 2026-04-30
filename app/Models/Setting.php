<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table ='settings';    

    protected $fillable =[
        'company',
        'address',
        'email',
        'phone',
        'whatsapp_phone',
        'reception_phone',
        'manager_phone',
        'restaurant_phone',
        'logo',
        'deliveryInfo',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'linktree',
        'google_reviews_url',
        'tripadvisor_reviews_url',
        'quote',
        'google_map_embed',
    ];
}
