<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['survey_id', 'user_name', 'q1', 'q2', 'q3', 'q4', 'q5'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}