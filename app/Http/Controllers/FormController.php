<?php


namespace App\Http\Controllers;

//use App\Exceptions\FormException;
//use App\Services\FormService;
//use Illuminate\Http\Request;
use App\Http\Requests\CustomFormRequest;
use App\Providers\addLogEvent;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
use App\Entities\Message;

class FormController extends Controller
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function submit(
        CustomFormRequest $customFormRequest,
        Person $person,
        Message $message
    ) {
        session()->forget('id');

        $validate = $customFormRequest->validated();


        $emails = array_column($this->em->getRepository(Person::class)->getPersonFromTable(), 'email');

        if (in_array($validate['email'], $emails)) {
            // Add message to person if he exist
            $user = $this->em->getRepository(Person::class)->findOneBy(['email' => $validate['email']]);
            session(['id' => $user->getId()]);
            $message->setPerson($user)->setContent($validate['message']);
            $person->addMessage($message);
            $this->em->persist($message);
            $this->em->flush();
            session(['msgId' => $message->getId()]);
        } else {
            // Add person and message
            $person->setName($validate['name'])->setEmail($validate['email']);
            $this->em->persist($person);
            $this->em->flush();
            $user = $this->em->getRepository(Person::class)->findOneBy(['email' => $validate['email']]);
            session(['id' => $user->getId()]);
            $message->setPerson($person)->setContent($validate['message']);
            $person->addMessage($message);
            $this->em->persist($message);
            $this->em->flush();
            session(['msgId' => $message->getId()]);
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

        return redirect()->route('form');
    }


    public function view()
    {
        $data = [];
        if (session()->has('id')) {
            $this->em->find(Person::class, session('id'));
            $message = $this->em->getRepository(Message::class)->findOneBy(['id' => session('msgId')]);
            if (isset($message)) {
                $data['personData'] = [
                    'name' => $message->getPerson()->getName(),
                    'email' => $message->getPerson()->getEmail(),
                    'message' => $message->getContent()
                ];
            }

        }

        return view('form', $data);
    }
}

