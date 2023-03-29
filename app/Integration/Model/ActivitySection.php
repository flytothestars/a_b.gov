<?php

namespace App\Integration\Model;

class ActivitySection
{
    public $id;
    public $name;
    public $description;
    public $code;
    public $activity_type;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
