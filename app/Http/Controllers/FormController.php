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

        $personsTable = $em->getRepository(Persons::class)->getPersonsTable();

        $emails = array_column($personsTable, 'email');

//        $qb = $em->createQueryBuilder();

        if (in_array($validate['email'], $emails)) {
            //Get person id
            foreach ($personsTable as $person) {
                if ($person['email'] === $validate['email']) {
                    $id = $person['id'];
                    // Save message
                    $messages->setPersonId($id)->setMessage($validate['message']);
                    $em->persist($messages);
                    $em->flush();
                }
            }
        } else {
            //Save person
            $persons->setName($validate['name'])->setEmail($validate['email']);
            $em->persist($persons);
            $em->flush();

            //Get person id
            $userId = $em->createQuery("SELECT p.id FROM App\Entities\Persons p WHERE p.email = '{$validate['email']}'")
                         ->getResult();

            $id = implode(array_unique(array_column($userId, 'id')));

            //Save message
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

