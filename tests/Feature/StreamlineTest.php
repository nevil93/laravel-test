<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\Person;
use App\Services\Streamline;

class StreamlineTest extends TestCase
{
    public function testIfAreEquals()
    {
        $streamline = new Streamline();
        $person = new Person();

        $arr = [
            'id' => null,
            'name' => null,
            'email' => null
        ];
        $this->assertEquals($arr, $streamline->convertToArray($person));
    }

    public function testIfReturnArray()
    {
        $streamline = new Streamline();
        $person = new Person();

        $this->assertTrue(is_array($streamline->convertToArray($person)));
    }

    public function testIfArrayHasKeys()
    {
        $streamline = new Streamline();
        $person = new Person();

        $this->assertArrayHasKey('name', $streamline->convertToArray($person));
    }
}
