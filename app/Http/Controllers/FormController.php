<?php


namespace App\Http\Controllers;

//use App\Exceptions\FormException;
//use App\Services\FormService;
//use Illuminate\Http\Request;
use App\Http\Requests\CustomFormRequest;
use App\Providers\addLogEvent;
use Doctrine\ORM\EntityManager;


class FormController extends Controller
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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

        $emailsDB = \DB::select('select email from persons');

        $emails = array_column($emailsDB, 'email');

        if (in_array($validate['email'], $emails)) {
            $selectPerson = \DB::select('select id, name from persons where email = ?', [$validate['email']]);
            $personName = array_column($selectPerson, 'name')[0];
            $personId = array_column($selectPerson, 'id')[0];
            if ($personName !== $validate['name']) {
                \DB::update('update persons set name = ? where id = ?', [$validate['name'], $personId]);
            }
            \DB::insert('insert into messages (person_id, message) values (?, ?)', [$personId, $validate['message']]);
        } else {
            \DB::insert('insert into persons (name, email) values (?, ?)', [$validate['name'], $validate['email']]);
            $ids = \DB::select('select id from persons where email = ?', [$validate['email']]);
            $personId = array_column($ids, 'id')[0];
            \DB::insert('insert into messages (person_id, message) values (?, ?)', [$personId, $validate['message']]);
        }

////        $test = (array) \DB::table('persons')->latest('id')->first();
////        $test1 = (array) \DB::table('messages')->latest('person_id')->first();

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

