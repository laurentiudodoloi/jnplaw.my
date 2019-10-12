<?php

namespace App\Util;

use Illuminate\Http\UploadedFile;

class FileUploader
{
    public static function store(UploadedFile $fileToUpload)
    {
        $resourceType = 'image';
        $success = true;

        if (strpos($fileToUpload->getClientMimeType(), 'video') !== false) {
            $resourceType = 'video';
        }

        $fileNameWithExt = $fileToUpload->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $fileToUpload->getClientOriginalExtension();

        $fileNameToStore = $fileName.'_'.time().'.'.$extension;

        $path = $fileToUpload->storeAs('public/uploads', $fileNameToStore);

        $success = !!$path;

        return [
            'success' => $success,
            'type' => $resourceType,
            'name' => $fileNameToStore,
        ];
    }
}
