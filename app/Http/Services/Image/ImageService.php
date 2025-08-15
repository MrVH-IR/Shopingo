<?php

namespace App\Http\Services\Image;

use Config;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Expr\Array_;

class ImageService extends ImageToolsService
{
    public function save($image)
    {
        $this->setImage($image);
        $this->provider();

        $manager = new ImageManager(new Driver());

        $result = $manager->read($image->getRealPath())
            ->save(
                public_path($this->getImageAddress()),
                quality: 90,
                format: $this->getImageExtension()
            );

        return $result ? $this->getImageAddress() : false;
    }

    public function fitAndSave($image, $width, $height)
    {
        $this->setImage($image);
        $this->provider();

        $manager = new ImageManager(new Driver());

        $result = $manager->read($image->getRealPath())
            ->cover($width, $height)
            ->save(
                public_path($this->getImageAddress()),
                quality: 90,
                format: $this->getImageExtension()
            );

        return $result ? $this->getImageAddress() : false;
    }

    public function createIndexAndSave($image) : Array
    {
        $imageSizes = Config::get('image.index-image-sizes');

        $this->setImage($image);

        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());

        $this->getImageName() ?? $this->setImageName(time());

        $imageName = $this->getImageName();

        $indexArray = [];

        foreach ($imageSizes as $sizeAliases => $imageSize) {
            $currentImageName = $imageName . "_" . $sizeAliases;

            $this->setImageName($currentImageName);

            $this->provider();

            $manager = new ImageManager(new Driver());

            $result = $manager->read($image->getRealPath())
                ->cover($imageSize['width'], $imageSize['height'])
                ->save(
                    public_path($this->getImageAddress()),
                    quality: 90,
                    format: $this->getImageExtension()
                );

            if ($result)
            {
                $indexArray[$sizeAliases] = $this->getImageAddress();
            } else {
                return false;
            }
        }

        $image['indexArray'] = $indexArray;
        $image['directory'] = $this->getFinalImageDirectory();
        $image['currentImage'] = Config::get('image.default-current-index-image');

        return $image;
    }
}
