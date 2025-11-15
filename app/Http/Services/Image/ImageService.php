<?php

namespace App\Http\Services\Image;

use Config;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService extends ImageToolsService
{

    /**
     * Save the original Picture
     * @param mixed $image
     * @return bool|string
     */
    public function save($image)
    {
        $this->setImage($image);
        $this->provider();

        $manager = new ImageManager(new Driver());

        $imageAddress = $this->getImageAddress($this->getFinalImageDirectory());
        $fullPath = public_path($imageAddress);
        $dir = dirname($fullPath);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $result = $manager->read($image->getRealPath())
            ->save(
                $fullPath,
                quality: 90,
                format: $this->getImageExtension()
            );

        return $result ? $imageAddress : false;
    }
    /**
     * @param $image
     * @param $width
     * @param $height
     * @return bool|string
     */

    public function fitAndSave($image, $width, $height)
    {
        $this->setImage($image);
        $this->provider();

        $manager = new ImageManager(new Driver());
        $imageAddress = $this->getImageAddress($this->getFinalImageDirectory());

        $result = $manager->read($image->getRealPath())
            ->cover($width, $height)
            ->save(
                public_path($this->getImageAddress($this->getFinalImageDirectory())),
                quality: 90,
                format: $this->getImageExtension()
            );

        return $result ? $imageAddress : false;
    }
    /**
     *
     * @param mixed $image
     * @return array{currentImage: mixed, directory: string, indexArray: array|array{currentImage: mixed, directory: string, indexArray: string[]}|array{message: string}}
     */
    public function createIndexAndSave($image) : array
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
                    public_path($this->getImageAddress($this->getFinalImageDirectory())),
                    quality: 90,
                    format: $this->getImageExtension()
                );

            if ($result)
            {
                $indexArray[$sizeAliases] = $this->getImageAddress($this->getFinalImageDirectory());
            } else {
                return ['message' => 'failed'];
            }
        }

        return [
            'indexArray' => $indexArray,
            'directory' => $this->getFinalImageDirectory(),
            'currentImage' => Config::get('image.default-current-index-image'),
        ];
    }

    public function deleteImage($imagePath): void
    {
        if (file_exists($imagePath))
        {
            unlink($imagePath);
        }
    }

    public function deleteIndex($image): void
    {
        $directory = public_path($image['directory']);
        $this->deleteDirectoryAndFiles($directory);
    }

    public function deleteIndexString($image): void
    {
        $directory = public_path($image);
        $this->deleteImage($directory);
    }

    public function deleteFile($filePath): void
    {
        $fullPath = public_path($filePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function deleteDirectoryAndFiles($directory): bool
    {

        if (!is_dir($directory))
        {
            return false;
        }
        $files = glob($directory . DIRECTORY_SEPARATOR . "*" , GLOB_MARK);
        foreach ($files as $file)
        {
            if(is_dir($file))
            {
                $this->deleteDirectoryAndFiles($file);
            }
            else {
                unlink($file);
            }
        }
        $result = rmdir($directory);
        return $result;
    }
}
