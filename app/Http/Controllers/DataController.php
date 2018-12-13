<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
use App\Entities\Message;

class DataController extends Controller
{
    public function displayData(EntityManager $em)
    {

        $persons = $em->getRepository(Person::class)->findAll();
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
}
