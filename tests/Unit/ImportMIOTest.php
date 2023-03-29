<?php


use PHPUnit\Framework\TestCase;

class ImportMIOTest extends TestCase
{
    public function setUp(): void {
        parent::setup();
    }

    public function testAuth()
    {
        $import = new \App\Integration\MIORestClient();
        $import->auth();
    }
}
