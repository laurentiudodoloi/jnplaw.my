<?php

namespace App\Util;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploader
{
    public static function store(UploadedFile $fileToUpload)
    {
        $uploadPath = config('app.upload_path');

        $resourceType = 'image';
        $success = true;

        if (strpos($fileToUpload->getClientMimeType(), 'video') !== false) {
            $resourceType = 'video';
        }

        $fileNameWithExt = $fileToUpload->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $fileToUpload->getClientOriginalExtension();

        $fileNameToStore = $fileName.'_'.time().'.'.$extension;

//        $path = $fileToUpload->storeAs($uploadPath, $fileNameToStore);

        $success = !!Storage::disk('uploads')->put($fileNameToStore, $fileToUpload->get());

        return [
            'success' => $success,
            'type' => $resourceType,
            'name' => $fileNameToStore,
        ];
    }
}
