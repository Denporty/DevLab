<?php

namespace App\Services;

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class CloudinaryService{

    public static ?Cloudinary $cloudinary = null;

    public static function getInstance(): ?Cloudinary
    {
        if (is_null(self::$cloudinary)){
            self::$cloudinary = new Cloudinary(config('services.cloudinary.url'));
        }
        return self::$cloudinary;
    }

    /**
     * Upload file and return secure_url
     * @param UploadedFile $real_path
     * @return string
     * @throws ApiError
     */
    public static function uploadAndGetUrl(UploadedFile $real_path): string
    {
        $image = Image::make($real_path);

        if ($image->width() > 1024){
            $image->widen(1024, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($real_path->getRealPath(), 80);
        }

        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($real_path->getRealPath());
        return self::getInstance()->uploadApi()->upload($real_path->getRealPath(), [
            'resource_type' => "auto"
        ])['secure_url'];
    }

    /**
     * Upload file and return secure_url
     * @param String $dataUrl
     * @return string
     * @throws ApiError
     */
    public static function uploadDataUrlAndGetUrl(String $dataUrl): string
    {
        $image = Image::make($dataUrl);

        if ($image->width() > 1024){
            $image->widen(1024, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($dataUrl, 80);
        }
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($dataUrl);
        return self::getInstance()->uploadApi()->upload($dataUrl)['secure_url'];
    }

    /**
     * @throws ApiError
     */
    public static function upload($image): string
    {
        if ($image instanceof UploadedFile){
            return self::uploadAndGetUrl($image);
        }elseif (str_starts_with($image, 'data:')) {
            return self::uploadDataUrlAndGetUrl($image);
        }
    }
}
