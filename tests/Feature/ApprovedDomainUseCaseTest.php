<?php

namespace Tests\Feature;

use App\ApprovedDomainUseCase;
use App\Domain;
use App\Jobs\DomainResolverJob;
use App\RecordType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApprovedDomainUseCaseTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_verify_data()
    {
        //Todo: Mock Domain Request
        $record = factory(RecordType::class)->create([
            'domain_id' => factory(Domain::class)->create(['name' => 'sadra.me'])->id,
            'content' => 'SHAYAN'
            ]);
        $record = $record->fresh();
        dispatch(new DomainResolverJob($record->domain->name, $record->fresh()));

        $domain = Domain::where('approved', true)->get();
        $this->assertCount(1,$domain);
    }
}
