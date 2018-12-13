<?php

namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    public function getMessageFromTable()
    {
        return $this->_em->createQuery('SELECT m.message FROM App\Entities\Message m')
                         ->getResult();
    }
}
