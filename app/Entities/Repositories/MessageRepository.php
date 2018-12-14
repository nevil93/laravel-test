<?php

namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;
use App\Entities\Person;
use App\Entities\Message;

class MessageRepository extends EntityRepository
{

    public function searchFiltering($searchRequest)
    {
        $queryBuilder = $this->_em->createQueryBuilder();



        if (empty($searchRequest)) {
            $result = $queryBuilder->select('p')
                                    ->from(Person::class, 'p')
                                    ->getQuery()
                                    ->getResult();
        } else {
            $result = $queryBuilder->select('p')
                                   ->from(Person::class, 'p')
                                   ->join(Message::class, 'm', 'WITH', 'p.id = m.person')
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
