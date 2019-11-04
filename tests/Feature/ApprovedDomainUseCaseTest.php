<?php

namespace Tests\Feature;

use App\ApprovedDomainUseCase;
use App\Domain;
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
        factory(RecordType::class)->create([
            'domain_id' => factory(Domain::class)->create(['name' => 'sadra.me'])->id,
            'content' => 'SHAYAN'
            ]);

        factory(RecordType::class)->create([
            'domain_id' => factory(Domain::class)->create(['name' => 'example.me'])->id,
            'content' => 'SHAYAN'
            ]);

        factory(RecordType::class)->create([
        'domain_id' => factory(Domain::class)->create(['name' => 'sadra.me'])->id,
        'content' => 'AFADG'
    ]);
        factory(RecordType::class)->create([
            'domain_id' => factory(Domain::class)->create(['name' => 'sadra.me'])->id,
            'content' => 'AFADG'
        ]);

        $useCase = new ApprovedDomainUseCase();
        $useCase->process();
        $domain = Domain::where('approved', true)->get();
        $this->assertCount(1,$domain);
    }
}
