<?php

namespace App\Integration\Model;

class Business
{
    public $id;
    public $name;
    public $display_name;
    public $location;
    public $address_line;
    public $address_line_stat;
    public $region;
    public $district;
    public $source;
    public $activity_subclasses;
    public $employee_count;
    public $has_cash_register;
    public $cash_register_count;
    public $has_payment_terminal;
    public $need_to_contact;
    public $refused_to_provide_identification_number;
    public $identification_number_not_found_in_stat;
    public $status;
    public $status_changed;
    public $created;
    public $modified;
    public $industries;


    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
