<?php

namespace Tests\Feature;

use App\User;
use App\Solicitude;
use App\Role;
use App\ProfessionalPractice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SolicitudeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_student_can_create_a_solicitude_for_a_pps()
    {
        $student = factory(User::class)->create(['role_id' => Role::student()]);

        $solicitude = factory(Solicitude::class)->raw(['user_id' => $student]);

        $this->be($student);

        $this->post('/solicitudes', $solicitude)
            ->assertRedirect('/solicitudes');

        $this->assertDatabaseHas('solicitudes', $solicitude);
    }

    public function test_only_logged_students_can_create_a_solicitude_for_a_pps()
    {
        $solicitude = factory(Solicitude::class)->raw();

        $this->post('/solicitudes', $solicitude)
            ->assertRedirect('/login');
    }

    /**
     * @dataProvider solicitudeFormValidationProvider
     */
    public function test_form_validation($inputName, $value)
    {
        $student = factory(User::class)->create(['role_id' => Role::student()]);

        $solicitude = factory(Solicitude::class)->raw([$inputName => $value]);

        $this->be($student)
            ->post('/solicitudes', $solicitude)
            ->assertSessionHasErrors($inputName);
    }

    public function solicitudeFormValidationProvider()
    {
        return [
            'The description is required' => ['description', '']
        ];
    }
}
