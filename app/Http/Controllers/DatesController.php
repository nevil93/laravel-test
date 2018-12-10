<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Persons;
use App\Entities\Messages;

class DatesController extends Controller
{
    public function showDates(EntityManager $em)
    {
        $qb = $em->createQueryBuilder();

        $persons = $em->getRepository(Persons::class)->getPersonsTable();
        $messages = $em->getRepository(Messages::class)->getMessagesTable();

        $personDates = [];
        foreach ($persons as $key => $person) {
            $personDates[] = ['name' => $person['name']];
            foreach ($messages as $message) {
                if ($person['id'] === $message['person_id']) {
                    $personDates[$key][] = ['message' => $message['message']];
                }
            }
        }

        $data['personDates'] = $personDates;




//        $personsDB = \DB::select('select id, name from persons');
//
//        $names = array_column($personsDB, 'name');
//        $ids = array_column($personsDB, 'id');
//
//        $persons = array_combine($ids, $names);
//
//        $personDates = [];
//
//        foreach ($persons as $key => $person) {
//            $messages = \DB::select('select message from messages where person_id = ?', [$key]);
//            $personDates[] = ['name' => $person, 'message' => array_column($messages, 'message')];
//        }
//
//        $data['personDates'] = $personDates;



//        $test = $em->find('App\Entities\Persons', 1);

        return view('dates', $data);
    }
}
