<?php

namespace App\Filesystem;

use App\Filesystem\Validator\ValidatorInterface;
use App\Notifications\Notifications;
use Illuminate\Validation\Validator;


class File extends Fileable
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var bool
     */
    public $canSave = true;

    /**
     * @var bool
     */
    public $failed = false;
    /**
     * @var
     */
    protected $attribute;

    public $message;
    /**
     * @return array
     */
    public function getFileData(): array
    {
        return [
            $this->name,
            $this->extension,
        ];
    }


    /**
     * @param string $attribute
     *
     * @return \App\Filesystem\File
     */
    public function load(string $attribute, $index = null): File
    {
        $this->name = $this->originalName($attribute, $index);
        $this->extension = $this->originalExtension($attribute, $index);
        $this->filename = $this->generateFilename();
        $this->attribute = $attribute;
        return $this;
    }

    public function loadFile($file){
        $explodedName = explode('.', $file->getClientOriginalName());
        unset($explodedName[count($explodedName) - 1]);
        $this->name = implode('.', $explodedName);
        $this->extension = $file->getClientOriginalExtension();
        $this->filename = $this->generateFilename();
        $this->attribute = $file;
        return $this;
    }
    /**
     * @param ValidatorInterface $validator
     * @param callable|null $callback
     * @return $this
     * Dependency inversion
     * SOLID
     */
    public function validate(ValidatorInterface $validator, callable $callback = null)
    {
        $check = $validator->validate();
        if ($check->fails()) {
            $this->message = $check->errors()->first();
            //Notifications::notify("error",$this->message);
            $this->canSave = false;
        }
        return $this;
    }

    /**
     * @param string $attribute
     *
     * @return \App\Filesystem\File
     */
    public function save($index = null): File
    {
        if($this->canSave){
            if(!is_null($index)){
                request()->file($this->attribute)[$index]->move(
                    public_path($this->source->getPath()),
                    $this->filename
                );
            }else{
                request()->file($this->attribute)->move(
                    public_path($this->source->getPath()),
                    $this->filename
                );
            }
        }else{
            $this->failed = true;
        }
        return $this;
    }

    public function saveFile($file){
        if($this->canSave){
                $file->move(
                    public_path($this->source->getPath()),
                    $this->filename
                );
        }else{
            $this->failed = true;
        }
        return $this;
    }


    /**
     * @param string $attribute
     *
     * @return string
     */
    protected function originalName(string $attribute, $index = null): string
    {
        if(!is_null($index)){
            $explodedName = explode('.', request()->file($attribute)[$index]->getClientOriginalName());
        }else{
            $explodedName = explode('.', request()->file($attribute)->getClientOriginalName());
        }
        unset($explodedName[count($explodedName) - 1]);

        return implode('.', $explodedName);
    }


    /**
     * @param string $attribute
     *
     * @return string
     */
    protected function originalExtension(string $attribute, $index = null): string
    {
        if(!is_null($index)){
            return request()->file($attribute)[$index]->getClientOriginalExtension();
        }else{
            return request()->file($attribute)->getClientOriginalExtension();
        }
    }


    /**
     * @return string
     */
    protected function generateFilename(): string
    {
        if(mb_strlen($this->name) > 30){
            $this->name = mb_substr($this->name,0,30);
        }
        return "{$this->generateRandomString()}_{$this->name}.{$this->extension}";
    }

}
