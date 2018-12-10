<?php


namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;

class PersonsRepository extends EntityRepository
{
    public function getPersonsTable()
    {
//        $this->createNamedQuery()->setDQL()
        return $this->_em->createQuery('SELECT p.id, p.name, p.email FROM App\Entities\Persons p')
                         ->getResult();
    }
}