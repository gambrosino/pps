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
        if ($user->from_dashboard) {
            Password::broker()->sendResetLink(['email' => $user->email]);
        }
        //Comment following line until project is finished
        Mail::to($user)->send(new NewUser($user->name));
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
