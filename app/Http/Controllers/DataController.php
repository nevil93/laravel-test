<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
//use App\Entities\Message;
use App\Services\FromObjectToArrayService;

class DataController extends Controller
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DataController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function search()
    {
//        $searchResult = $this->entityManager->getRepository(Person::class)->searchFiltering($request->get('search'));
//        $dataList = [];
//        foreach ($searchResult as $result) {
//            $personData = ['name' => $result->getName()];
//            foreach ($result->getMessages() as $message) {
//                $personData['message'][] = $message->getContent();
//            }
//            $dataList[] = $personData;
//        }
//        return redirect()->route('data')->with('result', $dataList);
        return view('data');
    }

    public function jsonResponse(Request $request, FromObjectToArrayService $converter)
    {
        $searchResult = $this->entityManager->getRepository(Person::class)->searchFiltering($request->get('search'));

        $data = $converter->convertToArray($searchResult);



        return response()->json($data);
    }
}
