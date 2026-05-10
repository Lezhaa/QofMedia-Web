<?php

namespace App\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryHelper
{
    /**
     * Upload foto
     */
    public static function uploadPhoto($file, $folder)
    {
        // Cara yang benar untuk upload
        $uploadedFile = Cloudinary::upload($file->getRealPath(), [
            'folder' => 'qofmedia/' . $folder,
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
                'width' => 1920,
                'height' => 1920,
                'crop' => 'limit',
            ]
        ]);
        
        return $uploadedFile;
    }
    
    /**
     * Upload video
     */
    public static function uploadVideo($file, $folder)
    {
        $uploadedFile = Cloudinary::uploadVideo($file->getRealPath(), [
            'folder' => 'qofmedia/' . $folder,
            'resource_type' => 'video',
        ]);
        
        return $uploadedFile;
    }
    
    /**
     * Hapus file
     */
    public static function delete($publicId, $type = 'image')
    {
        return Cloudinary::destroy($publicId, ['resource_type' => $type]);
    }
    
    /**
     * Get thumbnail URL
     */
    public static function thumbnail($publicId, $size = 400)
    {
        if (!$publicId) return null;
        
        return Cloudinary::getImage($publicId)->resize($size, $size)->toUrl();
    }
}