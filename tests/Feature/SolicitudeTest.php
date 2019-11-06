<?php

namespace Tests\Feature;

use App\Mail\NewSolicitude;
use App\Mail\SolicitudeUpdated;
use App\Role;
use App\Solicitude;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SolicitudeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_student_can_create_a_solicitude_for_a_pps()
    {
        $student = factory(User::class)->create(['role_id' => Role::student()]);

        $this->be($student);


        $this->post(route('solicitude.store'), [
            'description' => 'description test',
            'attachment' => UploadedFile::fake()->create('doc.pdf')
        ])
            ->assertRedirect(route('solicitude.create'));

        $solicitude = Solicitude::first();

        Storage::disk('local')->assertExists($solicitude->path);

    }

    public function test_only_logged_students_can_create_a_solicitude_for_a_pps()
    {
        $solicitude = factory(Solicitude::class)->raw();

        $this->post(route('solicitude.store'), $solicitude)
            ->assertRedirect(route('login'));
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

    public function test_update_state_fires_an_email()
    {
        Mail::fake();

        $solicitude = factory(Solicitude::class)->create();
        $solicitude->update(['status' => 'accepted']);

        $student = $solicitude->student;

        Mail::assertSent(SolicitudeUpdated::class, function ($mail) use ($student) {
            $this->assertTrue(
                $mail->hasTo($student->email),
                "The mail has not been sent to [{$student->email}]"
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
            ->post(route('solicitude.store'), $solicitude)
            ->assertSessionHasErrors($inputName);
    }

    public function solicitudeFormValidationProvider()
    {
        return [
            'The description is required' => ['description', ''],
            'The attachment is required' => ['attachment', null],
        ];
    }

    public function test_it_should_show_a_link_to_create_a_new_solicitude()
    {
        $student = factory(User::class)->create(['role_id' => Role::student()]);

        $this->be($student)->get(route('home'))
            ->assertSeeText('Crear Nueva Solicitud')
            ->assertStatus(200);
    }

}
