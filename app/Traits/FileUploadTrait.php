<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, $model,   $disk = 'public')
    {
        $folder = '';
        $fileName = Str::random(25) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $folder .= '/' . $model;
        $filePath = $file->storeAs($folder, $fileName, $disk);


        return $filePath;
    }

    public function getFileUrl()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }

    public function deleteFile()
    {
        if ($this->file_path) {
            Storage::disk('public')->delete($this->file_path);
            $this->update(['file_path' => null]);
        }
    }
}
