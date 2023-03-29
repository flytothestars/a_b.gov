<?php

namespace App\Integration\Model;

class RequirementType
{
    public $id;
    public $name;
    public $description;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
