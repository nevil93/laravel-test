<?php


namespace App\Entities\Repositories;

use Doctrine\ORM\EntityRepository;

class PersonRepository extends EntityRepository
{
    public function getPersonFromTable()
    {
//        $this->createNamedQuery('')->setDQL('');
        return $this->_em->createQuery('SELECT p.id, p.name, p.email FROM App\Entities\Person p')
                         ->getResult();
    }
}