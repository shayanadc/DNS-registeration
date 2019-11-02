<?php

namespace Tests\Unit;

use App\Domain;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DomainStateUpdateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_updates_domain_state_to_approved(){
        $domain = factory(Domain::class)->create(['name' => 'example.com']);
        $domain = Domain::find($domain->id);
        $this->assertFalse($domain->approved);
        $domain->toApproved();
//        $domain->fresh();
        $this->assertTrue($domain->approved);
    }
}
