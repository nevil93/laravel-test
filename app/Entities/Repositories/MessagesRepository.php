<?php

namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;

class MessagesRepository extends EntityRepository
{
    public function getMessagesTable()
    {
        return $this->_em->createQuery('SELECT m.person_id, m.message FROM App\Entities\Messages m')
                         ->getResult();
    }
}