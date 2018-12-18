<?php

namespace App\Services;


use App\Entities\Person;


class Streamline
{
    public function convertToArray(Person $person)
    {
        $data = [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'email' => $person->getEmail()
            ];

        foreach ($person->getMessages() as $message) {
            $data['messages'][] = $message->getContent();
        }
        return $data;
    }


}