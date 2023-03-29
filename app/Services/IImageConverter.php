<?php


namespace App\Services;


interface IImageConverter
{
    public function processImage(string $imagePath, string $watermarkPath = null, int $height = null) : string;
    public function makeThumbnail($srcImagePath, $height, $thumbDirectory) : string;
}
