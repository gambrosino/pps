<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
