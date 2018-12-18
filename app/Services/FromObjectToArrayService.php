<?php

namespace App\Services;


use App\Entities\Person;


class FromObjectToArrayService
{
    /**
     * @param Person $person
     * @return array
     */
    public function convertToArray(Person $person)
    {
        $data = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'email' => $person->getEmail()
            ];

        foreach ($person->getMessages() as $message) {
            $data['messages'][$message->getId()] = $message->getContent();
        }
        return $data;
    }
}
