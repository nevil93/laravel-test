<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\Person;
use App\Entities\Message;
use App\Services\FromObjectToArrayService;
use Faker\Factory as Faker;

class FromObjectToArrayServiceTest extends TestCase
{
    public function testIsCorrectArrayWhatIsReturned()
    {
        $converter = new FromObjectToArrayService();
        $person = new Person();
        $message = new Message();
        $reflectionPersonClass = new \ReflectionClass($person);
        $reflectionMessageClass = new \ReflectionClass($message);

        // Fake data
        $faker = Faker::create();
        $personId = $faker->unique()->randomNumber(2);
        $name = $faker->name;
        $email = $faker->unique()->email;
        $msg = $faker->word;
        $msgId = $faker->randomNumber(2);

        $setPersonId = $reflectionPersonClass->getProperty('id');
        $setPersonId->setAccessible(true);
        $setPersonId->setValue($person, $personId);
        $person->setName($name)->setEmail($email);
        $setMessageId = $reflectionMessageClass->getProperty('id');
        $setMessageId->setAccessible(true);
        $setMessageId->setValue($message, $msgId);
        $message->setPerson($person)->setContent($msg);
        $person->addMessage($message);

        $arr = [
            'id' => $personId,
            'name' => $name,
            'email' => $email,
            'messages' => [
                $msgId => $msg
            ]
        ];

        $this->assertEquals($arr, $converter->convertToArray($person));
    }

    public function testIsCorrectArrayWhatIsReturnedWithNullValues()
    {
        $converter = new FromObjectToArrayService();
        $person = new Person();

        $arr = [
            'id' => null,
            'name' => null,
            'email' => null
        ];
        $this->assertEquals($arr, $converter->convertToArray($person));
    }

}
