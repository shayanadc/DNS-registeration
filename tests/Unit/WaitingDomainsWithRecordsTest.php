<?php

namespace Tests\Unit;

use App\Domain;
use App\RecordType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WaitingDomainsWithRecordsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_returns_domains_not_approved()
    {
        factory(RecordType::class)->create(['domain_id'=> factory(Domain::class)->create()->id]);
        factory(RecordType::class)->create(['domain_id'=> factory(Domain::class)->create()->id]);
        factory(RecordType::class)->create(['domain_id'=> factory(Domain::class)->create()->id]);
        factory(RecordType::class)->create(['domain_id'=> factory(Domain::class)->create(['approved' => true])->id]);
        factory(RecordType::class)->create(['domain_id'=> factory(Domain::class)->create(['approved' => true])->id]);
        $waiting = Domain::waiting()->get();
        $this->assertCount(3, $waiting);
    }
}
