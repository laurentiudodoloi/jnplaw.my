<?php

namespace App\Util;

use Illuminate\Http\UploadedFile;

class FileResource
{
    protected $availableTypes = [];

    public function __construct()
    {
        //
    }

    public function availableTypes($types)
    {
        $this->availableTypes = $types;
    }

    public static function save(UploadedFile $file)
    {

    }
}
