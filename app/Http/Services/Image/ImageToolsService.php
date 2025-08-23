<?php

namespace App\Http\Services\Image;

class ImageToolsService
{

    protected $image;
    protected $exclusiveDirectory;
    protected $imageDirectory;
    protected $imageName;
    protected $imageExtension;
    protected $finalImageDirectory;
    protected $finalImageName;

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, '/\\');
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = trim($imageDirectory, '/\\');
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function setCurrentImageName($imageName)
    {
        return !empty($this->image) ? $this->setImageName(pathinfo($this->image->getClientOriginalName() , PATHINFO_FILENAME)) : false;
    }

    public function getImageExtension()
    {
        return $this->imageExtension;
    }

    public function setImageExtension($imageExtension)
    {
         $this->imageExtension = $imageExtension;
    }

    public function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }

    public function setFinalImageDirectory($finalImageDirectory)
    {
        $this->finalImageDirectory = trim($finalImageDirectory, '/\\');
    }

    public function getFinalImageName()
    {
        return $this->finalImageName;
    }

    public function setFinalImageName($finalImageName)
    {
        $this->finalImageName = $finalImageName;
    }

    protected function checkDirectory($imageDirectory)
    {
        if(!file_exists($imageDirectory))
        {
            mkdir($imageDirectory, 0777, true);
        }
    }

    public function getImageAddress($imageDirectory)
    {
        return $this->finalImageDirectory . DIRECTORY_SEPARATOR .$this->finalImageName;
    }

    protected function provider()
    {
        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') .  DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->getImageName() ?? $this->setImageName(time());
        $this->getImageExtension() ?? $this->setImageExtension($this->image->extension());

        $finalImageDirectory = $this->getExclusiveDirectory() ? $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory() : $this->getImageDirectory();

        $this->setFinalImageDirectory($finalImageDirectory);

        $this->setFinalImageName($this->getImageName() . '.' . $this->getImageExtension());

        $this->checkDirectory($this->getFinalImageDirectory());
    }
}
