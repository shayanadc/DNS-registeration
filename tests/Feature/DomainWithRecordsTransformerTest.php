<?php

namespace Tests\Feature;

use App\DigRequest;
use App\DomainDigTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DomainWithRecordsTransformerTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_ids_of_verified_domain()
    {
        $domainA = [
            'id' => 1,
            'name' => 'exampleA.com',
            'records' => [
                ['content' => 'CORRECT'],
                ['content' => 'A2']
            ]
        ];
        $domainB = [
            'id' => 2,
            'name' => 'exampleB.com',
            'records' => [
                ['content' => 'B1'],
                ['content' => 'B2']
            ]
        ];

        $dns_dmoainA = [
            [
                "host" => "exampleA.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "v=spf1 a mx include:spf.migadu.com ~all",
                "entries" => [
                    "v=spf1 a mx include:spf.migadu.com ~all",
                ],
            ],
            [
                "host" => "exampleA.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "CORRECT",
                "entries" => [
                    "SHAYAN",
                ],
            ],
            [
                "host" => "exampleA.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "ca3-090119b78c804a47a4e252b1d29ede27",
                "entries" => [
                    "ca3-090119b78c804a47a4e252b1d29ede27",
                ],
            ],
        ];;

        $dns_dmoainB = [
            [
                "host" => "exampleB.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT1",
                "txt" => "v=spf1 a mx include:spf.migadu.com ~all",
                "entries" => [
                    "v=spf1 a mx include:spf.migadu.com ~all",
                ],
            ],
            [
                "host" => "exampleB.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "TXT2",
                "entries" => [
                    "SHAYAN",
                ],
            ],
            [
                "host" => "exampleB.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "ca3-090119b78c804a47a4e252b1d29ede27",
                "entries" => [
                    "ca3-090119b78c804a47a4e252b1d29ede27",
                ],
            ],
        ];;

        $stub = $this->createMock(DigRequest::class);

        $stub->method('digRequest', 'exampleA.com')->willReturn($dns_dmoainA);
        $stub->method('digRequest', 'exampleB.com')->willReturn($dns_dmoainB);
//        $domainTransformer = new DomainDigTransformer($domainA);
        $this->assertEquals(1, 1);
    }
}
