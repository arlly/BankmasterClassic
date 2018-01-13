<?php

namespace AppBundle\Usecase;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFile
{
    private $targetDir;

    public function __construct(String $targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function run(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getTargetDir(), $fileName);
        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}