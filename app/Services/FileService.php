<?php

namespace App\Services;

use Illuminate\Support\Str;

class FileService
{
    public function SaveFile($file, $name, $type, $description, $user, $organization)
    {
        $fileSlug = Str::slug($name);
        $fileName = $fileSlug . '.' . $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $file->storeAs('public/'.$type, $fileName);
        $filePath = 'storage/'. $type .'/' . $fileName;
        $fileUploadBy = $user;
        $fileOrganization = $organization;
        $fileSave = array(
            'name' => $fileName,
            'slug' => $fileSlug,
            'file' => $fileSlug,
            'file_type' => $type,
            'description' => $description,
            'size' => $fileSize,
            'organization_id' => $organization,
            'created_by' => $user,
        );
        return $fileSave;
    }
}
