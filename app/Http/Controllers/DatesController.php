<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function showDates()
    {
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

        return view('dates', $data);
    }
}
