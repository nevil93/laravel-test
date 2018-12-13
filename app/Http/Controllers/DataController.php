<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
use App\Entities\Message;

class DataController extends Controller
{
    public function displayData(EntityManager $em)
    {

        $persons = $em->getRepository(Person::class)->findAll();
        $personData = [];
        foreach ($persons as $key => $person) {
            $personData[] = ['name' => $person->getName()];
            foreach ($person->getMessages()->getValues() as $message) {
                $personData[$key]['message'][] = $message->getContent();
            }
        }
        $data['personData'] = $personData;


        $personsDB = \DB::select('select id, name from persons');

        $names = array_column($personsDB, 'name');
        $ids = array_column($personsDB, 'id');

        $persons = array_combine($ids, $names);

        $personDates = [];

        foreach ($persons as $key => $person) {
            $messages = \DB::select('select message from messages where person_id = ?', [$key]);
            $personDates[] = ['name' => $person, 'message' => array_column($messages, 'message')];
        }

        $data['personDates'] = $personDates;



        return view('data', $data);
    }
}
