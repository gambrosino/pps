<?php

namespace Tests\Unit;

use App\ProfessionalPractice;
use App\Revision;
use App\Solicitude;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

class ProfessionalPracticeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_have_revisions()
    {
        $practice = factory(ProfessionalPractice::class)->create();
        factory(Revision::class, 3)->create(['professional_practice_id' => $practice]);

        $this->assertInstanceOf(Collection::class, $practice->revisions);
        $this->assertCount(3, $practice->revisions);
    }

    public function test_it_should_have_a_solicitude()
    {
        $practice = factory(ProfessionalPractice::class)->create();

        $this->assertInstanceOf(Solicitude::class, $practice->solicitude);
    }

    public function test_it_should_have_a_tutor()
    {
        $practice = factory(ProfessionalPractice::class)->create();

        $this->assertInstanceOf(User::class, $practice->tutor);
    }
}
