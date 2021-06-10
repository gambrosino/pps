<?php

namespace App\Observers;

use App\User;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //Comment following line until project is finished
        Mail::to($user)->send(new NewUser($user->name));
        if ($user->role_id == User::ROLES['TUTOR']) {
            Password::broker()->sendResetLink(['email' => $user->email]);
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }
}
