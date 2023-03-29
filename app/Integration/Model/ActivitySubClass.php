<?php

namespace App\Integration\Model;

class ActivitySubClass
{
    public $id;
    public $name;
    public $description;
    public $code;
    public $activity_class;
    public $tags;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
