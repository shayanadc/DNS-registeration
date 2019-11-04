<?php

namespace Tests\Feature;

use App\DigRequest;
use App\DNSDigRequestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DigRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_true_if_find_dns_record_for_domain()
    {
        $TXTDigRequest = [
            [
                "host" => "sadra.me",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "v=spf1 a mx include:spf.migadu.com ~all",
                "entries" => [
                    "v=spf1 a mx include:spf.migadu.com ~all",
                ],
            ],
            [
                "host" => "sadra.me",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "SHAYAN",
                "entries" => [
                    "SHAYAN",
                ],
            ],
            [
                "host" => "sadra.me",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "ca3-090119b78c804a47a4e252b1d29ede27",
                "entries" => [
                    "ca3-090119b78c804a47a4e252b1d29ede27",
                ],
            ],
        ];

        $stub = $this->createMock(DigRequest::class);

        $stub->method('digRequest')
            ->willReturn($TXTDigRequest);
        $recordsType = [
            [
                "id" => 1,
                "domain_id" => "1",
                "content" => "hash"
            ], [
                "id" => 2,
                "domain_id" => "2",
                "content" => "text1",
            ], [
                "id" => 3,
                "domain_id" => "2",
                "content" => "SHAYAN"
            ]
        ];
        $dnsFactory = new DNSDigRequestFactory($stub->digRequest(), $recordsType);
        $this->assertTrue($dnsFactory->process());
    }
}
