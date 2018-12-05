<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function showDates()
    {
        $personsDB = \DB::select('select name from persons');

        $persons = array_column($personsDB, 'name');

        $personDates = [];
        foreach ($persons as $key => $person) {
            $messages = \DB::select('select message from messages where person_id in (?)', [++$key]);
            $personDates[] = array('name' => $person, 'message' => array_column($messages, 'message'));
        }

        $data['personDates'] = $personDates;

        return view('dates', $data);
    }




}
