<?php

namespace App\Integration\Model;

class Entity
{
    public $id;
    public $name;
    public $full_name;
    public $identification_number;
    public $activity_codes;
    public $is_individual;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
