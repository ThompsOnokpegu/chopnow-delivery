<?php

namespace App\Services;


use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{

    /**
     * Upload a file to Cloudinary.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string|null  $folder
     * @return array  ['url' => string, 'public_id' => string]
     */
    public function upload(UploadedFile $file, string $folder): array
    {
         
        $uploadResult = $file->storeOnCloudinary($folder);

        return [
            'url'       => $uploadResult->getSecurePath(),
            'public_id' => $uploadResult->getPublicId(),
        ];
    }

    /**
     * Delete a resource from Cloudinary.
     *
     * @param  string  $publicId
     * @return array
     */
    public function delete(string $publicId)
    {
        return Cloudinary::destroy($publicId);
    }

   
}
