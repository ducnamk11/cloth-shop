<?php

namespace App\Traits;

use Storage;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldname, $folderName)
    {
        if ($request->hasFile($fieldname)) {
            $file = $request->$fieldname;
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = str_random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldname)->storeAs('public/' . $folderName . '/' . auth()->id(), $filenameHash);
            $dataUpload = [
                'file_name' => $filenameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUpload;
        } else {
            return null;

        }
    }

    public function storageTraitUploadMultiple($file, $folderName)
    {
        $filenameOrigin = $file->getClientOriginalName();
        $filenameHash = str_random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $filenameHash);
        $dataUpload = [
            'file_name' => $filenameOrigin,
            'file_path' => Storage::url($filePath),
        ];
        return $dataUpload;

    }
}
