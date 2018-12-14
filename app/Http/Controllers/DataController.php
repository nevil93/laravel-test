<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
use App\Entities\Message;

class DataController extends Controller
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function displayData()
    {
        /** @var Person[] $persons */
        $persons = $this->entityManager->getRepository(Person::class)->findAll();
        $dataList = [];
        foreach ($persons as $person) {
            $personData = ['name' => $person->getName()];
            foreach ($person->getMessages() as $message) {
                $personData['message'][] = $message->getContent();
            }
            $dataList[] = $personData;
        }

        $data['dataList'] = $dataList;

        return view('data', $data);
    }

    public function search(Request $request)
    {
        $searchResult = $this->entityManager->getRepository(Message::class)->searchFiltering($request->get('search'));

        $dataList = [];
        foreach ($searchResult as $result) {
            $personData = ['name' => $result->getName()];
            foreach ($result->getMessages() as $message) {
                $personData['message'][] = $message->getContent();
            }
            $dataList[] = $personData;
        }

        return redirect()->route('data')->with('result', $dataList);
    }
}
