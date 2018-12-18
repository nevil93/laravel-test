<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\Person;
use App\Services\FromObjectToArrayService;

class FromObjectToArrayServiceTest extends TestCase
{
    public function testIsCorrectArrayWhatIsReturned()
    {
        $streamline = new FromObjectToArrayService();
        $person = new Person();

        $arr = [
            'id' => null,
            'name' => null,
            'email' => null
        ];
        $this->assertEquals($arr, $streamline->convertToArray($person));
    }
}
