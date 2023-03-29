<?php

namespace App\Integration\Model;

class Region
{
    public $id;
    public $name;
    public $city;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
