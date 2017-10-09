<?php

namespace App\Http\Utilities;

use File;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploads
{
    /**
     * media image file.
     *
     * @var object
     */
    protected $file;

    /**
     * Media File Name.
     *
     * @var object
     */
    protected $fileName;

    /**
     * Base Dir.
     *
     * @var string
     */
    public $baseDir;

    /**
     * Generate Thumbnail.
     *
     * @var string
     */
    public $isThumbnail;

    /**
     * Original File Name.
     *
     * @var string
     */
    public $isOriginalName;

    /**
     * File Path.
     *
     * @var string
     */
    public $filePath;

    /**
     * Base Dir.
     *
     * @var string
     */
    public $thumbnailPath;

    public function __construct()
    {
        $this->isThumbnail = true;
        $this->isOriginalName = false;
        $this->baseDir = public_path('img');
        $this->thumbnailPath = 'thumbnail';
    }

    /**
     * Get File Name.
     *
     * @param string $prefix
     *
     * @return string
     */
    public function setFileName($prefix = null, $manualFileName = null)
    {
        if ($manualFileName) {
            return $this->fileName = $manualFileName;
        }

        if ($this->isOriginalName) {
            $this->fileName = $this->file->getClientOriginalName();

            return $this->fileName;
        }

        if ($prefix) {
            $this->fileName = time().'_'.$prefix.'_'.$this->file->getClientOriginalName();

            return $this->fileName;
        }

        $this->fileName = time().'_'.$this->file->getClientOriginalName();

        return $this->fileName;
    }

    /**
     * Get Thumbnail Flag.
     *
     * @return $this
     */
    public function getThumbnailFlag()
    {
        return  $this->isThumbnail;
    }

    /**
     * Set Thumbnail Flag.
     *
     * @param bool $flag
     *
     * @return $this
     */
    public function setThumbnailFlag($flag = false)
    {
        $this->isThumbnail = $flag;

        return $this;
    }

    /**
     * Get Original File Name Flag.
     *
     * @return $this
     */
    public function getOriginalFileNameFlag()
    {
        return  $this->isOriginalName;
    }

    /**
     * Set Original File Name Flag.
     *
     * @return $this
     */
    public function setOriginalFileNameFlag($flag = false)
    {
        $this->isOriginalName = $flag;

        return $this;
    }

    /**
     * Get File Name.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set Base Path description].
     *
     * @param string $path
     *
     * @return $this
     */
    public function setBasePath($path)
    {
        $this->filePath = $this->baseDir.DIRECTORY_SEPARATOR.$path;

        return $this;
    }

    /**
     * Get Base Path.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->filePath;
    }

    /**
     * Set Thumbnail Path.
     *
     * @param string $path
     */
    public function setThumbnailPath($path)
    {
        $this->thumbnailPath = $path;

        return $this;
    }

    /**
     * Get Thumbnail Path.
     *
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * Upload File.
     *
     * @param UploadedFile $file
     *
     * @return $this
     */
    public function upload(UploadedFile $file, $manualFilename = null)
    {
        $this->setFile($file);

        $filePath = $this->getBasePath();
        $filePath = $this->checkAndCreateDir($filePath);
        if ($manualFilename) {
            $fileName = $this->setFileName(null, $manualFilename);
        } else {
            $fileName = $this->setFileName();
        }

        $file = $this->file->move($filePath, $fileName);

        if ($file) {
            $this->makeThumbnail($fileName);

            /*if(strpos($_SERVER["HTTP_REFERER"], 'special-management') !== false || strpos($_SERVER["HTTP_REFERER"], 'campaign') !== false)
            {
                $source = $filePath.'/'.$fileName;
                $destination = $filePath.'/'.$fileName;
                $quality = 90;

                $this->compress($source, $destination, $quality);
            }*/

            return $fileName;
        }

        return $this;
    }

    /**
     * This function is used for reducing file size.
     *
     * @param string location of souce image
     * @param string location of destination image
     * @param int quality percentage
     *
     * @return $this
     */
    public function compress($source, $destination, $quality)
    {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
            imagegif($image, $destination, $quality);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
            imagepng($image, $destination, $quality);
        } else {
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
        }

        return $destination;
    }

    /**
     * Set File.
     *
     * @param object
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Make Thumbnail.
     *
     * @return mixed
     */
    public function makeThumbnail($file)
    {
        if ($this->isThumbnail) {
            $referenceFile = $this->getBasePath().DIRECTORY_SEPARATOR.$file;
            $fileName = $this->getFileName();
            $filePath = $this->getBasePath().DIRECTORY_SEPARATOR.$this->getThumbnailPath();
            $filePath = $this->checkAndCreateDir($filePath);

            Image::make($referenceFile)
                    ->fit(200)
                    ->save($filePath.DIRECTORY_SEPARATOR.$fileName);

            return $this;
        }

        return $file;
    }

    /**
     * Delete File.
     *
     * @param string $filePath
     *
     * @return $this
     */
    public function deleteFile($filePath)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);

            return true;
        }

        return false;
    }

    /**
     * Delete Directory.
     *
     * @param string $path
     *
     * @return $this
     */
    public function deleteDirectory($path)
    {
        if (is_dir($path)) {
            \Storage::disk('local')->deleteDirectory($path);
        }
    }

    /**
     * Check And Create Dir.
     *
     * @param string $path
     *
     * @return string $path
     */
    public function checkAndCreateDir($path)
    {
        if (is_dir($path)) {
            return $path;
        }

        mkdir($path, 0777, true);

        return $path;
    }

    /**
     * Move file.
     *
     * @param string $source
     * @param string $destination
     *
     * @return bool
     */
    public function moveFile($source, $destination)
    {
        $filePath = $this->getBasePath();
        $source = $filePath.DIRECTORY_SEPARATOR.$source;
        $destination = $filePath.DIRECTORY_SEPARATOR.$destination;
        if (File::exists($source)) {
            $dir = dirname($destination);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            return File::move($source, $destination);
        }

        return false;
    }

    /**
     * Copy file.
     *
     * @param string $source
     * @param string $destination
     *
     * @return bool
     */
    public function copyFile($source, $destination)
    {
        $filePath = $this->getBasePath();
        $source = $filePath.DIRECTORY_SEPARATOR.$source;
        $destination = $filePath.DIRECTORY_SEPARATOR.$destination;
        if (File::exists($source)) {
            $dir = dirname($destination);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            return File::copy($source, $destination);
        }

        return false;
    }

    /**
     * Remove directory.
     *
     * @param string $path
     *
     * @return bool
     */
    public function removeDirectory($path)
    {
        $filePath = $this->getBasePath();
        $path = $filePath.DIRECTORY_SEPARATOR.$path;

        return recursiveRemoveDirectory($path);
    }
}
