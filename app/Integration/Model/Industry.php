<?php

namespace App\Integration\Model;

class Industry
{
    public $id;
    public $name;
    public $industry_type;
    public $activity_subclass;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
