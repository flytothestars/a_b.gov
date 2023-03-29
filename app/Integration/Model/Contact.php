<?php

namespace App\Integration\Model;

class Contact
{
    public $id;
    public $business;
    public $full_name;
    public $phone_number;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
