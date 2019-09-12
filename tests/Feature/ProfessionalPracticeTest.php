<?php

namespace Tests\Feature;

use App\User;
use App\Solicitude;
use App\Role;
use App\ProfessionalPractice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfessionalPracticeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_professional_practice_for_a_given_solicitude()
    {
        $solicitude_id = factory(Solicitude::class)->create()->id;
        $tutor_id = factory(User::class)->create(['role_id' => Role::tutor()])->id;

        $this->be(factory(User::class)->create(['role_id' => Role::admin()]));

        $body = compact('solicitude_id', 'tutor_id');

        $practice = factory(ProfessionalPractice::class)->raw($body);

        $this->post('/professional-practices', $body);

        $this->assertDatabaseHas('professional_practices', $practice);
    }

    public function test_solicitude_should_be_accepted_after_the_practice_is_created()
    {
        $practice = factory(ProfessionalPractice::class)->raw();
        $this->be(factory(User::class)->create(['role_id' => Role::admin()]))
            ->post('/professional-practices', $practice);

        $solicitude = ProfessionalPractice::find($practice)->first()->solicitude;

        $this->assertEquals($solicitude->status, 'accepted');
    }

    /**
     * @dataProvider professionalPracticeFormValidationProvider
     */
    public function test_form_validation($inputName, $value)
    {
        $practice = factory(ProfessionalPractice::class)->raw([$inputName => $value]);

        $this->be(factory(User::class)->create(['role_id' => Role::admin()]))
            ->post('/professional-practices', $practice)
            ->assertSessionHasErrors($inputName);
    }

    public function professionalPracticeFormValidationProvider()
    {
        return [
            'The tutor id is required' => ['tutor_id', ''],
            'The solicitude id is required' => ['solicitude_id', '']
        ];
    }
}
