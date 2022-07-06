<?php

namespace App\Filesystem;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;


class Thumbnail extends Fileable
{
    /**
     * @param \App\Filesystem\Fileable $file
     * @param int                      $width
     * @param int                      $height
     *
     * @return \App\Filesystem\Thumbnail
     */
    public function make(Fileable $file, int $width, int $height): Thumbnail
    {
        $this->generateFilename($file);

        $size = new Box($width, $height);

        app('orchestra.imagine')
            ->open(public_path(trim($file->getStoredPath(), '/')))
            ->thumbnail($size, ImageInterface::THUMBNAIL_OUTBOUND)
            ->save(public_path($this->source->getPath()) . '/' . $this->filename);

        return $this;
    }


    /**
     * @param \App\Filesystem\Fileable $file
     *
     * @return string
     */
    protected function generateFilename(Fileable $file): string
    {
        $storedPath = $file->getStoredPath();
        $explodedStoredPath = explode('/', $storedPath);
        $filename = $explodedStoredPath[count($explodedStoredPath) - 1];

        $extensionPosition = strrpos($filename, '.');
        $thumb = substr($filename, 0, $extensionPosition) . '.thumb' . substr($filename, $extensionPosition);

        return $this->filename = $thumb;
    }

}
