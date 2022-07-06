<?php


namespace App\Filesystem\Validator;


use Illuminate\Validation\Validator;

class VideoValidator implements ValidatorInterface
{
    protected $rules = [];
    protected $fields = [];
    public function __construct(array $fields)
    {
        $this->rules = array_fill_keys(array_values($fields),'mimes|mp4');
        $this->fields = request()->only($fields);
    }

    public function validate(): Validator
    {
        $validator = \Validator::make($this->fields, $this->rules);
        return $validator;
    }

    public function getFields(){
        return $this->fields;
    }
}
