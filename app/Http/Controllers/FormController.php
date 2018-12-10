<?php


namespace App\Http\Controllers;

//use App\Exceptions\FormException;
//use App\Services\FormService;
//use Illuminate\Http\Request;
use App\Http\Requests\CustomFormRequest;
use App\Providers\addLogEvent;
use Doctrine\ORM\EntityManager;
use App\Entities\Persons;
use App\Entities\Messages;

class FormController extends Controller
{
    public function submit(
        CustomFormRequest $customFormRequest,
        EntityManager $em,
        Persons $persons,
        Messages $messages
    ) {
        $validate = $customFormRequest->validated();

        if ($validate) {
            session(['results' => $validate]);
            event(new addLogEvent('Dates are submited'));
        } else {
            event(new addLogEvent([]));
        }


        $qb = $em->createQueryBuilder();

        $emails = $qb->select('e.email')
                     ->from(Persons::class, 'e')
                     ->getQuery()
                     ->getResult();

        if (in_array($validate['email'], array_column($emails, 'email'))) {
            //Get person id
            $personId = $qb->select('p1.id')
                ->from(Persons::class, 'p1')
                ->where('p1.email = ?1')
                ->setParameter(1, $validate['email'])
                ->getQuery()
                ->getResult();

            $id = implode(array_unique(array_column($personId, 'id')));

            $messages->setPersonId($id)->setMessage($validate['message']);
            $em->persist($messages);
            $em->flush();
        } else {
            //Save person in table Persons
            $persons->setName($validate['name'])->setEmail($validate['email']);
            $em->persist($persons);
            $em->flush();

            //Get person id
            $personId = $qb->select('p2.id')
                           ->from(Persons::class, 'p2')
                           ->where('p2.email = ?1')
                           ->setParameter(1, $validate['email'])
                           ->getQuery()
                           ->getResult();

            $id = implode(array_unique(array_column($personId, 'id')));

            //Save person message in table message
            $messages->setPersonId($id)->setMessage($validate['message']);
            $em->persist($messages);
            $em->flush();
        }





//        $emailsDB = \DB::select('select email from persons');
//
//        $emails = array_column($emailsDB, 'email');
//
//        if (in_array($validate['email'], $emails)) {
//            $ids = \DB::select('select id from persons where email = ?', [$validate['email']]);
//            $person_id = array_column($ids, 'id')[0];
//            \DB::insert('insert into messages (person_id, message) values (?, ?)', [$person_id, $validate['message']]);
//        } else {
//            \DB::insert('insert into persons (name, email) values (?, ?)', [$validate['name'], $validate['email']]);
//            $ids = \DB::select('select id from persons where email = ?', [$validate['email']]);
//            $person_id = array_column($ids, 'id')[0];
//            \DB::insert('insert into messages (person_id, message) values (?, ?)', [$person_id, $validate['message']]);
//        }
//
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

