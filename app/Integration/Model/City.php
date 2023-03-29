<?php

namespace App\Integration\Model;

class City
{
    public $id;
    public $name;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
