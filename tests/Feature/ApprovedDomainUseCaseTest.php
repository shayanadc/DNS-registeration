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
            'domain_id' => factory(Domain::class)->create(['name' => 'example.com'])->id,
            'content' => 'LookForThisTXTRecord'
            ]);
        $record = $record->fresh();
        $ucMock = $this->getMockBuilder(ApprovedDomainUseCase::class)
            ->setConstructorArgs(['example.me', $record])
            ->setMethods(array('sendDigRequest'))
            ->getMock();
        $DNS = [
            [
                "host" => "example.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "v=spf1 a mx include:spf.migadu.com ~all",
                "entries" => [
                    "v=spf1 a mx include:spf.migadu.com ~all",
                ],
            ],
            [
                "host" => "example.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "LookForThisTXTRecord",
                "entries" => [
                    "LookForThisTXTRecord",
                ],
            ]
        ];
        $ucMock->expects($this->once())
            ->method('sendDigRequest')
            ->will($this->returnValue($DNS));
        $ucMock->process();

        $domain = Domain::where('approved', true)->get();
        $this->assertCount(1,$domain);
    }
}
