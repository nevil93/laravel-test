<?php


namespace App\Http\Controllers;

//use App\Exceptions\FormException;
//use App\Services\FormService;
//use Illuminate\Http\Request;
use App\Http\Requests\CustomFormRequest;
use App\Providers\addLogEvent;


class FormController extends Controller
{

    /**
     * @param CustomFormRequest $customFormRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(CustomFormRequest $customFormRequest)
    {
        $validate = $customFormRequest->validated();

        if ($validate) {
            session(['results' => $validate]);
            event(new addLogEvent('Dates are submited'));
        } else {
            event(new addLogEvent([]));
        }

        return redirect()->route('form')/*->withErrors([])*/;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        if (session()->has('results')) {
            \Log::info('Reading from session');
        }
        return view('form');
    }
}

