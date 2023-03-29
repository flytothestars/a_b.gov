<?php

namespace App\Integration;

interface IMioIntegrationService
{
    public function upload();
    public function updateBusinessLocation();
    public function updateBusinessByIds();
    public function updateBusinessWorkingType();
    public function uploadFileBusEn($file, $count);
    public function uploadFile($file, $count);
    public function createForm();
    public function fileUploadBus($request);
    public function uploadFileUpdate($file, $count);
    public function uploadFileUpdateCreate($file, $count);
}
