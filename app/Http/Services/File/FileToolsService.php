<?php

namespace App\Http\Services\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileToolsService
{
    protected ?UploadedFile $file = null;

    protected int $fileSize;

    protected string $fileName;

    protected string $fileExtension;

    public function setFile(UploadedFile $file): FileToolsService
    {
        $this->file = $file;
        $this->setFileName($file->getClientOriginalName());
        $this->setFileExtension($file);
        $this->setFileSize();
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $originalName): void
    {
        if (str_contains($originalName, '.')) {
            $this->fileName = substr($originalName, 0, strripos($originalName, '.'));
        } else {
            $this->fileName = $originalName;
        }
    }

    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    public function setFileExtension(UploadedFile $file): void
    {
        $this->fileExtension = $file->getClientOriginalExtension();
    }

    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    protected function setFileSize(): void
    {
        $this->fileSize = $this->file?->getSize() ?? 0;
    }

    public function saveInStorage(): array|bool
    {
        if (!$this->file) return false;

        try {
            $path = $this->file->storeAs(
                'uploads' . DIRECTORY_SEPARATOR . $this->getFileExtension(),
                $this->getFileName() . '_' . time() . '.' . $this->getFileExtension(),
                'local'
            );

            return [
                "path" => $path,
                "name" => $this->getFileName(),
                "extension" => $this->getFileExtension(),
                "size" => $this->getFileSize(),
            ];
        } catch (\Exception $e) {
            \Log::error("File save error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteFile($path): bool
    {
        if (!Storage::exists($path)) return false;

        return Storage::delete($path);
    }

    public static function formatSize($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.2f", $bytes / pow(1024, $factor)) . ' ' . @$units[$factor];
    }
}
