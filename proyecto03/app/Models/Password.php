<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $fillable = [
        'value', 'length', 'include_upper', 'include_numbers', 'include_symbols'
    ];

    protected $casts = [
        'include_upper' => 'boolean',
        'include_numbers' => 'boolean',
        'include_symbols' => 'boolean',
    ];
}