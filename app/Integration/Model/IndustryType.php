<?php

namespace App\Integration\Model;

class IndustryType
{
    public $id;
    public $name;
    public $industry_category;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
