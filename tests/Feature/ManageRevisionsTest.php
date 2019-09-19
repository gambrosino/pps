<?php

namespace Tests\Feature;

use App\Revision;
use Tests\TestCase;
use App\Mail\NewRevision;
use App\ProfessionalPractice;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function test_documents_can_be_attached()
    {
        Storage::fake('documents');

        $revision = factory(Revision::class)->create();
        $student = $revision->professionalPractice->solicitude->student;

        $this->be($student)
            ->patch('/revisions/' . $revision->id, [
                'document' => UploadedFile::fake()->create('doc.pdf'),
                'title' => 'example'
        ]);

        $newDocument = $revision->refresh()->documents->first();

        $this->assertEquals('example', $newDocument->title);

        Storage::disk('local')->assertExists($newDocument->path);
    }
}
