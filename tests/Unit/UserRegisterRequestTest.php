<?php

namespace Tests\Unit;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterRequestTest extends TestCase
{
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new UserRegisterRequest();
    }

    public function testRules()
    {
        $this->assertEquals([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ],
            $this->subject->rules()
        );
    }

    public function testAuthorize()
    {
        $this->assertTrue($this->subject->authorize());
    }
}
