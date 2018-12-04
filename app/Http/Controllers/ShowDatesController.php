<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowDatesController extends Controller
{
    public function showDates()
    {
        $persons = \DB::select('select name from persons');

        dd($persons);
        return view('dates');
    }
}
