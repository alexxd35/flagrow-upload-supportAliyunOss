<?php

namespace Flagrow\Upload\Events\File;

use Flagrow\Upload\File;

class WasLoaded
{
    /**
     * @var File
     */
    public $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }
}
