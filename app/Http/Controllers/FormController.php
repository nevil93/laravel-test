<?php


namespace App\Http\Controllers;

//use App\Exceptions\FormException;
//use App\Services\FormService;
use Illuminate\Http\Request;
use App\Http\Requests\CustomFormRequest;
use App\Providers\addLogEvent;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
use App\Entities\Message;

class FormController extends Controller
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function submit(
        CustomFormRequest $customFormRequest,
        Person $person,
        Message $message
    ) {
        session()->forget('id');

        $validate = $customFormRequest->validated();


        $emails = array_column($this->entityManager->getRepository(Person::class)->getPersonFromTable(), 'email');

        if (in_array($validate['email'], $emails)) {
            // Add message to person if he exist
            $user = $this->entityManager->getRepository(Person::class)->findOneBy(['email' => $validate['email']]);
            session(['id' => $user->getId()]);
            $message->setPerson($user)->setContent($validate['message']);
            $person->addMessage($message);
            $this->entityManager->persist($message);
            $this->entityManager->flush();
            session(['msgId' => $message->getId()]);
        } else {
            // Add person and message
            $person->setName($validate['name'])->setEmail($validate['email']);
            $this->entityManager->persist($person);
            $this->entityManager->flush();
            $user = $this->entityManager->getRepository(Person::class)->findOneBy(['email' => $validate['email']]);
            session(['id' => $user->getId()]);
            $message->setPerson($person)->setContent($validate['message']);
            $person->addMessage($message);
            $this->entityManager->persist($message);
            $this->entityManager->flush();
            session(['msgId' => $message->getId()]);
        }

        return redirect()->route('form');
    }


    public function view()
    {
        $data = [];
        if (session()->has('id')) {
            $message = $this->entityManager->getRepository(Message::class)->findOneBy(['id' => session('msgId')]);
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

