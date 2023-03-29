<?php

namespace App\Integration\Model;

class ActivityGroup
{
    public $id;
    public $name;
    public $description;
    public $code;
    public $activity_section;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
