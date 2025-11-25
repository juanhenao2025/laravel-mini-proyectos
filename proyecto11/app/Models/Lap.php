<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lap extends Model
{
    protected $fillable = ['user_name', 'lap_time'];
}