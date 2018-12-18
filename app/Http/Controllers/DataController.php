<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
//use App\Entities\Person;
use App\Entities\Message;
use App\Services\Streamline;

class DataController extends Controller
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function search(Request $request, Streamline $streamline)
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
