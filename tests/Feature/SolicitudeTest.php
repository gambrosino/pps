<?php

namespace Tests\Feature;

use App\ProfessionalPractice;
use App\Role;
use App\Solicitude;
use App\User;
use App\Mail\NewSolicitude;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

    public function test_new_solicitude_fires_email()
    {
        Mail::fake();

        $admin = factory(User::class)->create(['role_id' => Role::admin()]);

        $solicitude = factory(Solicitude::class)->create();

        Mail::assertSent(NewSolicitude::class, function ($mail) use ($admin) {
            $this->assertTrue(
                $mail->hasTo($admin->email),
                "The mail has not been sent to [{$admin->email}]"
            );
            return true;
        });
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
