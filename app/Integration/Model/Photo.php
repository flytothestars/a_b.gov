<?php

namespace App\Integration\Model;

class Photo
{
    public $id;
    public $business;
    public $description;
    public $photo_url;


    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
