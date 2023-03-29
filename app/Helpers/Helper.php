<?php


namespace App\Helpers;


use Carbon\Carbon;

class Helper
{

    public static function getStorageFileExtension($path)
    {
        return substr($path, strrpos($path, "."));
    }

    public static function getThumbnailDirectory() : string
    {
        return 'thumbnails';
    }

    public static function getAttributeValue(string $name, array $attributes)
    {
        return array_key_exists($name, $attributes) ? $attributes[$name] : null;
    }

    public static function dateToUtcMIO($stringFrom)
    {
        [$datetime, $tzOffset] = explode('+', $stringFrom);

        return Carbon::createFromFormat('Y-m-d H:i:s.u', str_replace('T', ' ', $datetime), 'UTC')
            // ->setTimeZone('Asia/Almaty')
            ->utc()
            ->format('Y-m-d H:i:s');
    }
    public static function dateToUtcMIO2($stringFrom)
    {
        [$datetime, $tzOffset] = explode('+', $stringFrom);

        return Carbon::createFromFormat('Y-m-d H:i:s.u', str_replace('T', ' ', $datetime), 'UTC')
            // ->setTimeZone('Asia/Almaty')
            ->format('Y-m-d H:i:s');
    }
}
