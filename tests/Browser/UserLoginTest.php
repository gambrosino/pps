<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserLoginTest extends DuskTestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @return void
     * @throws \Throwable
     */
    public function testLogin()
    {
        $user = factory(\App\User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login', [], false))
                ->assertSee('LOGIN')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('LOGIN')
                ->assertPathIs(route('home', [], false));
        });
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function testLogout()
    {
        $user = factory(\App\User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('home', [], false))
                ->assertSee('LOGOUT')
                ->press('LOGOUT')
                ->assertPathIs(route('login', [], false));
        });
    }
}
