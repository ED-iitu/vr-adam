<?php

namespace App\Filesystem;

class Source
{

    /**
     * @var string
     */
    private $basePath = 'storage';

    /**
     * @var
     */
    protected $path;


    /**
     * Source constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->setPath($path);
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $this->basePath . "/" . trim($path, '/');
    }

}
