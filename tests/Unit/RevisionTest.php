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

    public function test_documents_can_be_attached()
    {
        $oldDocument = factory(Document::class)->create();

        $revision = Revision::find($oldDocument->revision_id);

        $this->assertCount(1, $revision->documents);

        $revision->attachDocument(['title' => 'example', 'path' => 'example.pdf']);

        $this->assertCount(2, $revision->fresh()->documents);
    }

    public function test_overall_status()
    {
        $revision = factory(Revision::class)->create();

        $documents = factory(Document::class)->create(['revision_id' => $revision]);

        $this->assertEquals('in-review', $revision->fresh()->getOverallStatus());

        $documents->first()->update(['status' => 'rejected']);
        $this->assertEquals('rejected', $revision->fresh()->getOverallStatus());

        $documents->each(function ($document) {
            $document->update(['status' => 'accepted']);
        });
        $this->assertEquals('accepted', $revision->fresh()->getOverallStatus());
    }
}
