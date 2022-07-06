<?php

namespace App\Filesystem;

abstract class Fileable
{

    /**
     * @var \App\Filesystem\Source
     */
    protected $source;

    /**
     * @var string
     */
    protected $filename;


    /**
     * Fileable constructor.
     *
     * @param \App\Filesystem\Source $source
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }


    /**
     * @return string
     */
    public function getStoredPath(): string
    {
        return '/' . $this->getPathToFile($this->filename);
    }


    /**
     * @return string
     */
    protected function generateRandomString(): string
    {
        return uniqid(rand() + time(), true);
    }


    /**
     * @param string $filename
     *
     * @return string
     */
    protected function getPathToFile($filename): string
    {
        return "{$this->source->getPath()}/{$filename}";
    }

}
