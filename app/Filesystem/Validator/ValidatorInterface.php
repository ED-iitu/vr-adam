<?php


namespace App\Filesystem\Validator;

interface ValidatorInterface
{
    public function __construct(array $fields);
    public function validate(): \Illuminate\Validation\Validator;
    public function getFields();
}
