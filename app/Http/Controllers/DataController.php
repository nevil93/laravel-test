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

        $personsDB = \DB::select('select id, name from persons');

        $names = array_column($personsDB, 'name');
        $ids = array_column($personsDB, 'id');

        $persons = array_combine($ids, $names);

        $personData = [];

        foreach ($persons as $key => $person) {
            $messages = \DB::select('select message from messages where person_id = ?', [$key]);
            $personData[] = ['name' => $person, 'message' => array_column($messages, 'message')];
        }

        $data['personData'] = $personData;

        return view('data', $data);
    }
}
