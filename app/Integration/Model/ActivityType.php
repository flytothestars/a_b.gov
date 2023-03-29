<?php

namespace App\Integration\Model;

class ActivityType
{
    public $id;
    public $name;
    public $description;
    public $code;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
