<?php

namespace Tests\Feature;

use App\DNSLookUp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DNSFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_true_if_find_txt_record_in_dns_records()
    {
        $TXTDigRequest = [
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
            ],
            [
                "host" => "example.com",
                "class" => "IN",
                "ttl" => 473,
                "type" => "TXT",
                "txt" => "ca3-090119b78c804a47a4e252b1d29ede27",
                "entries" => [
                    "ca3-090119b78c804a47a4e252b1d29ede27",
                ],
            ],
        ];

        $recordsType =
            [
                "id" => 1,
                "domain_id" => "1",
                "content" => "text1"
            ];

        $dns_look_up = new DNSLookUp($recordsType, $TXTDigRequest);
        $this->assertFalse($dns_look_up->isMatch());
    }
}
