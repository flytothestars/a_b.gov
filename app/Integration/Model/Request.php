<?php

namespace App\Integration\Model;

class Request
{
    public $id;
    public $business;
    public $description;
    public $requirement;
    public $status;
    public $status_changed;
    public $created;
    public $modified;

    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
