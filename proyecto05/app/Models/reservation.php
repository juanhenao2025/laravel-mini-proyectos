<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'reserved_at',
        'service',
        'confirmed',
    ];
}