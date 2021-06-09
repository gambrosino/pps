<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    CONST ROLES = [
        'ADMIN' => '1',
        'STUDENT' => '2',
        'TUTOR' => '3',
    ];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'file_number', 'deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            if (!isset($user->role)) {
                $user->role()->associate(Role::student());
            }
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitude::class);
    }

    public function supervisedPractices()
    {
        return $this->hasMany(ProfessionalPractice::class, 'tutor_id');
    }
}
