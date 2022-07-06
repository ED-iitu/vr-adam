<?php

namespace App\Filesystem;

class Local
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $extension;
    protected $filename;


    /**
     * @param string $filepath
     */
    public function setFileData(string $filepath): void
    {
        $this->name = $this->originalName($filepath);
        $this->extension = $this->originalExtension($filepath);
        $this->filename = $this->originalFileName();
    }


    /**
     * @return array
     */
    public function getFileData(): array
    {
        return [
            $this->name,
            $this->extension,
            $this->filename,
        ];
    }


    /**
     * @param string $filepath
     *
     * @return string
     */
    protected function originalName(string $filepath): string
    {
        $exploded = explode('/', $filepath);
        $exploded = explode('.', $exploded[count($exploded) - 1]);

        unset($exploded[count($exploded) - 1]);

        return implode('.', $exploded);
    }


    /**
     * @param string $filepath
     *
     * @return string
     */
    protected function originalExtension(string $filepath): string
    {
        $exploded = explode('.', $filepath);

        return $exploded[count($exploded) - 1];
    }

    protected function originalFileName(){
        return "{$this->name}.{$this->extension}";
    }
}
