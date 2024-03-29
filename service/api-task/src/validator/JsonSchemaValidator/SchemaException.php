<?php

namespace App\Validator\JsonSchemaValidator;

class SchemaException extends \InvalidArgumentException
{
    protected $hint;

    public function __construct($msg, $hint = "")
    {
        parent::__construct($msg);
        $this->hint = $hint;
    }

    public function getHint()
    {
        return $this->hint;
    }
}