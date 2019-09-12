<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public static function student()
    {
        return self::where('name', 'student')->first();
    }

    public static function tutor()
    {
        return self::where('name', 'tutor')->first();
    }

    public static function admin()
    {
        return self::where('name', 'admin')->first();
    }
}
