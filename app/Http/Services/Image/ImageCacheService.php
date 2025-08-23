<?php

namespace App\Http\Services\Image;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\JpegEncoder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;

class ImageCacheService
{
    public function cache($imagePath, $size = null): Response
    {
        $imageSizes = Config::get('image.cache-image-sizes');
        if (!isset($imageSizes[$size])) {
            $size = Config::get('image.default-current-cache-image');
        }
        $width = $imageSizes[$size]['width'];
        $height = $imageSizes[$size]['height'];
        if (file_exists($imagePath)) {
            $cacheKey = "image_cache:{$size}:" . md5($imagePath);

            $binary = Cache::remember(
                $cacheKey,
                now()->addMinutes(Config::get('image.image-cache-life-time')),
                function () use ($imagePath, $width, $height) {
                    $img = Image::read($imagePath)->cover($width, $height);
                    $encoded = $img->encode(new JpegEncoder(quality: 80));

                    return base64_encode((string) $encoded);
                }
            );

            $decoded = base64_decode($binary);

            return response($decoded)->header('Content-Type', 'image/jpeg');
        } else {
            $img = Image::create($width, $height)
                ->fill('#cdcdcd')
                ->text('Image Not Found', $width / 2, $height / 2, function ($font) {
                    $font->filename(public_path('admin-assets/fonts/IRANSans/IRANSansWeb.woff'));
                    $font->size(24);
                    $font->color('#333333');
                    $font->align('center');
                    $font->valign('center');
                });

            $encoded = $img->encode(new JpegEncoder(quality: 80));

            return response((string) $encoded)->header('Content-Type', $encoded->mimeType());
        }
    }
}
