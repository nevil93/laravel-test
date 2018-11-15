<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{


    public function formRequest(Request $request){


        session(['name' => $request->name]);
        session(['email' => $request->email]);
        session(['message' => $request->message]);

        return view('/view');
    }
}

