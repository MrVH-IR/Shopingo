<?php

namespace App\Http\Services\PublicFile;

use Illuminate\Http\UploadedFile;


class PublicFile {

    protected string $directory;
    protected UploadedFile $file;

    public function __construct($file , $directory = "")
    {
        $this->file = $file;
        $this->directory = $directory;
    }

    public function __invoke()
    {
        if (! is_dir($this->directory) && isset($this->directory))
        {
            mkdir(public_path($this->directory) , 0777, true);
        }
        $this->directory == null ? "uploads" : $this->directory;
        $this->file == null ? exit("File Was Not Uploaded Or Passed Here.") : $this->file;

        $this->file->move_uploaded_file($this->file , public_path($this->directory));

        return [
            "status" => "success",
            "path"   => public_path($this->directory),
            "file"   => public_path($this->directory . DIRECTORY_SEPARATOR . $this->file)
        ];
    }
}
