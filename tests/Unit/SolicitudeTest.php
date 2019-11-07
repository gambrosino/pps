<?php

namespace Tests\Unit;

use App\ProfessionalPractice;
use App\Role;
use App\Solicitude;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitudeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_must_has_a_student()
    {
        $user = factory(User::class)->create(['role_id' => Role::student()]);

        $solicitude = factory(Solicitude::class)->create(['user_id' => $user]);

        $this->assertInstanceOf(User::class, $solicitude->student);

        $this->assertEquals(Role::student()->name, $solicitude->student->role->name);
    }

    public function test_it_must_has_a_pps()
    {
        $solicitude = factory(Solicitude::class)->create();

        $professionalPractice = factory(ProfessionalPractice::class)->create(['solicitude_id' => $solicitude]);

        $this->assertInstanceOf(ProfessionalPractice::class, $solicitude->professionalPractice);

        $this->assertEquals($professionalPractice->id, $solicitude->professionalPractice->id);

    }
}
