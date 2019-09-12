<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_view()
    {
        $response = $this->get('/')
            ->assertStatus(200)
            ->assertViewIs('welcome');        
    }


    public function test_home_view()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $response = $this->get('/home')
            ->assertStatus(200)
            ->assertViewIs('home');        
    }
}