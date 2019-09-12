<?php

namespace Tests\Unit;

use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_role()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Role::class, $user->role);
    }

    public function test_default_role_is_student()
    {
        $user = factory(User::class)->create(['role_id' => null]);

        $this->assertEquals($user->role, Role::student());
    }
}
