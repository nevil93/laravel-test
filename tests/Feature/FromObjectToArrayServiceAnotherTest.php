<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\Person;
use App\Services\FromObjectToArrayService;

class FromObjectToArrayServiceAnotherTest extends TestCase
{
    public function testIsCorrectArrayWhatIsReturned()
    {
        $streamline = new FromObjectToArrayService();
        $person = new Person();

        $person->setName('Nicolai')->setEmail('nicolai@gmail.com');

        $arr = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'email' => $person->getEmail()
        ];
        $this->assertEquals($arr, $streamline->convertToArray($person));
    }
}
