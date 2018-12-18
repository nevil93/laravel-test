<?php

namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;
use App\Entities\Person;

class MessageRepository extends EntityRepository
{
    /**
     * @param $searchRequest
     * @return mixed
     */
    public function searchFiltering($searchRequest)
    {
        $queryBuilder = $this->_em->createQueryBuilder();


        $personTable = $queryBuilder->select('p')->from(Person::class, 'p');
        if (empty($searchRequest)) {
            $result = $personTable->getQuery()->getResult();
        } else {
            $result = $personTable->leftJoin('p.messages', 'm')
                                   ->where($queryBuilder->expr()->orX(
                                       $queryBuilder->expr()->like('p.name', '?1'),
                                       $queryBuilder->expr()->like('m.content', '?2')
                                   ))
                                   ->setParameters([1 => '%'.$searchRequest.'%', 2 => '%'.$searchRequest.'%'])
                                   ->getQuery()
                                   ->getResult();
        }

        return $result;
    }
}
