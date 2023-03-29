<?php

namespace App\Helpers;

use App\Models\Organization;
use App\Repositories\Enums\CitiesEnum;
use App\Repositories\Enums\DistrictsEnum;
use Illuminate\Support\Str;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HelperExcelImport
{


    function getIntegerIfEmpty($string)
    {
        if (is_int($string)) {
            return $string;
        } else {
            return 0;
        }
    }

    function getValidNumber($string)
    {
        if (is_int($string)) {
            return $string;
        } else {
            if (is_float($string)) {
                return $string;
            } else {
                if (is_string($string)) {
                    return 0;
                } else {
                    return 0;
                }
            }
        }
    }

    function mbUcFirst($string, $encoding)
    {
        if (!$string) {
            return null;
        }
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then      = mb_substr($string, 1, null, $encoding);
        return mb_strtoupper($firstChar, $encoding) . mb_strtolower($then);
    }

    function getParsedNumber($string)
    {
        $directions = [
            'первое' => '1',
            '1'      => '1',
            'I'      => '1',
            'второе' => '2',
            '2'      => '2',
            'II'     => '2',
        ];

        foreach ($directions as $key => $value) {
            if (strpos((string)$string, (string)$key) !== false) {
                return $value;
            }
        }
        return null;
    }


    function getDistrictId($string)
    {
        foreach (DistrictsEnum::DistrisctsList as $key => $value) {
            if (strpos((string)mb_strtoupper($string), (string)mb_strtoupper($value)) !== false) {
                return $key;
            }
        }
        return null;
    }

    function getRegionId($string)
    {
        foreach (CitiesEnum::CitiesList as $key => $value) {
            if (strpos(Str::lower($string), Str::lower($value)) !== false) {
                return $key;
            }
        }
        return null;
    }

    function yesNo($string)
    {
        switch ($string) {
            case 'да':
                return 1;
                break;
            case 'нет':
                return 0;
                break;
            default:
                return null;
                break;
        }
    }

    function getDoublePercent($string)
    {
        if (!$string) {
            return null;
        }
        if (is_float($string)) {
            return $string * 100;
        }
        if (substr_count($string, ',') > 1) {
            $string = substr_replace($string, "", strrpos($string, ',', -1), 1);
        }

        return str_replace([ '%', ',', '/' ], [ '', '.', '.' ], $string);
    }

    function getCompanyUserId($bin)
    {
        $oraganization = Organization::query()
                                     ->where('iin', '=', trim($bin))
                                     ->first()
        ;
        if (
            $oraganization
            && $oraganization->profile
        ) {
            return $oraganization->profile->user_id ?? null;
        }
        return null;
    }

    function getCompanyId($bin)
    {
        $oraganization = Organization::query()
                                     ->where('iin', '=', trim($bin))
                                     ->first()
        ;

        return $oraganization
            ? $oraganization->id
            : null;
    }

    function validateDate($date)
    {
        if (is_int($date) || is_float($date)) {
            return Date::excelToDateTimeObject($date)
                       ->format('Y-m-d')
                ;
        }

        return null;
    }
}
