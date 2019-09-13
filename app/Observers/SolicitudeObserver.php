<?php

namespace App\Observers;

use App\Role;
use App\User;
use App\Solicitude;
use App\Mail\NewSolicitude;
use Illuminate\Support\Facades\Mail;

class SolicitudeObserver
{
    /**
     * Send a notification email to all admin
     * users when a new Solicitude is created.
     *
     * @param Solicitude $solicitude
     * @return void
     */
    public function created(Solicitude $solicitude)
    {
        $admins = User::whereHas('role', function ($q) {
            $q->where('name', 'admin');
        })->get();

        Mail::to($admins)->send(new NewSolicitude());
    }
}
