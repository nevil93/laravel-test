<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Entities\Person;
//use App\Entities\Message;
use App\Services\PersonSerializerService;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('data');
    }

    /**
     * @param Request $request
     * @param PersonSerializerService $converter
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(Request $request, PersonSerializerService $converter)
    {
        $search = json_decode($request->get('search'), true);
        $searchResult = $this->entityManager->getRepository(Person::class)->searchFiltering($search['value']);

        $data = [];
        foreach ($searchResult as $result) {
            $data[] = $converter->convertToArray($result);
        }

        return response()->json($data, 200);
    }
}
