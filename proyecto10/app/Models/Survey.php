<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['title'];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}