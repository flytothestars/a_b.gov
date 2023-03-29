<?php

namespace App\Integration\Model;

class District
{
    public $id;
    public $name;
    public $region;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
