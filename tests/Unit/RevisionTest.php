<?php

namespace Tests\Unit;

use App\ProfessionalPractice;
use App\Revision;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RevisionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_must_have_a_professional_practice()
    {
        $revision = factory(Revision::class)->create();

        $this->assertInstanceOf(ProfessionalPractice::class, $revision->professionalPractice);
    }
}
