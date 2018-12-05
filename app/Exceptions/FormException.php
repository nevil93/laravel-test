<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class FormException extends Exception
{
    private $errors;

    /**
     * FormException constructor.
     * @param string $message
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errors = [], string $message = "", int $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function returnErrors()
    {
        return $this->errors;
    }


}
