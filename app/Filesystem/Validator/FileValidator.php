<?php


namespace App\Filesystem\Validator;


use Illuminate\Validation\Validator;

class FileValidator implements ValidatorInterface
{
    protected $rules = [];
    protected $fields = [];
    public function __construct(array $fields)
    {
        $this->rules = array_fill_keys(array_values($fields),'mimes:pdf,psd,ai,eps,ait,svg,xlsx,xls,csv,txt,docx,doc,zip,rar,jpg,png,jpeg,video,mp4,avi,mov,mpeg4,mpeg,mp3,wav,aac,ogg,wma,ppt,pptx,m4a|max:40480');
        $this->fields = request()->only($fields);
    }

    public function validate(): Validator
    {
        $validator = Validator::make($this->fields, $this->rules);
        return $validator;
    }

    public function getFields(){
        return $this->fields;
    }
}
