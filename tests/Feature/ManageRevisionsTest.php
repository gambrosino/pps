<?php

namespace Tests\Feature;

use App\Revision;
use Tests\TestCase;
use App\Mail\NewRevision;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageRevisionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_revision_fires_an_email()
    {
        Mail::fake();

        $practice = factory(Revision::class)->create()->professionalPractice;
        $tutor = $practice->tutor;

        Mail::assertSent(NewRevision::class, function ($mail) use ($tutor) {
            $this->assertTrue(
                $mail->hasTo($tutor->email),
                "The email has not been sent to [{$tutor->email}]"
            );
            return true;
        });
    }
}
