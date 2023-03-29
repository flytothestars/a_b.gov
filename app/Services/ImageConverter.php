<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageConverter implements IImageConverter
{
    public function processImage(string $imagePath, string $watermarkPath = null, int $height = null) : string
    {
        if(!$watermarkPath && !$height)
            return $imagePath;

        $img = Image::make(Storage::disk('public')->path($imagePath))->orientate();
        if($height && $img->height() <= $height && !$watermarkPath)
            return $imagePath;

        if($height)
            $img = $this->resize($img, $height);

        if($watermarkPath)
            $img = $this->addWatermark($img, $watermarkPath);

        $img->save(Storage::disk('public')->path($imagePath));

        return $imagePath;
    }

    public function makeThumbnail($srcImagePath, $height, $thumbDirectory) : string
    {
        $img = Image::make(Storage::disk('public')->path($srcImagePath))->orientate();
        $img = $this->resize($img, $height);

        $directory = pathinfo($srcImagePath, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . $thumbDirectory . DIRECTORY_SEPARATOR;

        if(!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $thumbnailFileName =  $directory . basename($srcImagePath);
        $img->save(Storage::disk('public')->path($thumbnailFileName));

        return $thumbnailFileName;
    }

    private function addWatermark($img, string $watermarkPath)
    {
        if(!$img instanceof \Intervention\Image\Image){
            $img = Image::make($img);
        }
        $watermark = Image::make($watermarkPath);
        return $img->insert($watermark, 'top-right');
    }


    private function resize(\Intervention\Image\Image $img, $maxHeight)
    {
        if($img->height() > $maxHeight) {
            $img->resize(null, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $img;
    }

    private function rotate($fileName, $angle)
    {
        $img = Image::make($fileName);
        return $img->rotate($angle);
    }
}
