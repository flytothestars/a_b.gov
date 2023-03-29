<?php

namespace App\Integration\Model;

class Requirement
{
    public $id;
    public $name;
    public $description;
    public $requirement_type;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
