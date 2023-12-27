<?php

namespace App\Services;

use App\Jobs\ScalePostImage;
use Illuminate\Http\UploadedFile;

class FileService
{

    public function saveImage(UploadedFile|null $file = null): string|null
    {
        $filePath = null;
        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            ScalePostImage::dispatch($filePath);
        }

        return $filePath;
    }
}