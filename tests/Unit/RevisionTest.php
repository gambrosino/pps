<?php

namespace Tests\Unit;

use App\Document;
use App\Revision;
use Tests\TestCase;
use App\ProfessionalPractice;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RevisionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_must_have_a_professional_practice()
    {
        $revision = factory(Revision::class)->create();

        $this->assertInstanceOf(ProfessionalPractice::class, $revision->professionalPractice);
    }

    public function test_it_should_have_documents()
    {
        $revision = factory(Revision::class)->create();

        $this->assertInstanceOf(Collection::class, $revision->documents);
    }

    public function test_it_can_be_created_by_a_student()
    {
        $professionalPractice = factory(ProfessionalPractice::class)->create();

        $student = $professionalPractice->solicitude->student;

        $revision = factory(Revision::class)->raw();

        $this->be($student)->post(route('revision.store', $professionalPractice), $revision);

        $this->assertCount(1, $professionalPractice->revisions);
    }

    public function test_documents_can_be_attached()
    {
        $oldDocument = factory(Document::class)->create();

        $revision = Revision::find($oldDocument->revision_id);

        $this->assertCount(1, $revision->documents);

        $revision->attachDocument(['title'=> 'example', 'path' => 'example.pdf']);

        $this->assertCount(2, $revision->fresh()->documents);
    }
}
