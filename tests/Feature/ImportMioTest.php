<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportMioTest extends TestCase
{
    public function testAuth()
    {
        $import = new \App\Import\ImportMIO();
        $result = $import->auth();
        $this->assertIsString($result);
    }

    public function testGetBusiness()
    {
        $import = new \App\Import\ImportMIO();
        $result = $import->getBusiness(10, 0);
        $this->assertIsArray($result);
    }
}
