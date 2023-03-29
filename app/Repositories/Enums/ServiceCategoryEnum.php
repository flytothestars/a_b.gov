<?php

namespace App\Repositories\Enums;

abstract class ServiceCategoryEnum
{
    const FinancialServices = '61163fe6-7ea1-47c2-9248-5336b6d45d9b';
    const FreeEducation = '86fb5edc-82db-47d4-ab31-e9a9285b16ab';
    const ConsultingAndAccompanying = '91da119d-478f-497e-b966-1c8d7f0f9013';
    const HelpPermittingDocuments = 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3';
    const Taxing = '33244a88-10cd-4487-b549-32d31ac4ec4f';
    const OpenBusiness = '8988c6a5-4bec-498d-9b76-98df6167035f';

    public const ServiceList = [
        self::FinancialServices => 'FinancialServices',
        self::FreeEducation => 'FreeEducation',
        self::ConsultingAndAccompanying => 'ConsultingAndAccompanying',
        self::HelpPermittingDocuments => 'HelpPermittingDocuments',
        self::Taxing => 'Taxing',
        self::OpenBusiness => 'OpenBusiness'
    ];

     public static function GetServiceName($categoryTd)
    {
       return self::ServiceList[$categoryTd];
    }
}








