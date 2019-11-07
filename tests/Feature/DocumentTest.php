<?php

namespace Tests\Feature;

use App\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_be_reviewed()
    {
        $this->withoutExceptionHandling();
        $document = factory(Document::class)->create();

        $tutor = $document->revision->professionalPractice->tutor;

        $this->be($tutor)
            ->put(route('documents.update', ['document' => $document]), $accepted = ['status' => 'accepted'])
            ->assertRedirect(route('professional-practices.index'));

        $accepted['id'] = $document->id;
        $this->assertDatabaseHas('documents', $accepted);
    }
}
