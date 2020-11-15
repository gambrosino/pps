<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUser;

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
        //TODO: Uncomment this function at the end of the project
        //Mail::to($user)->send(new NewUser($user->name));
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
