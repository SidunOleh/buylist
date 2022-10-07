<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation_Exception extends Exception
{
    private $errors;

    public function __construct($errors, $message='', $code=0)
    {
        $this->errors = $errors;

        parent::__construct($message, $code);
    }

    public function errors()
    {
        return $this->errors;
    }
}
