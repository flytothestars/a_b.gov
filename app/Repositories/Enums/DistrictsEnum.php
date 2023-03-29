<?php

namespace App\Repositories\Enums;

abstract class DistrictsEnum
{

    const Alatau = '5b56bea2-1583-49b6-93f9-34305e700e79';
    const Almaly = '64b4e789-47b0-440a-b498-e26921555ff8';
    const Auezov = '52813f0a-c445-43dd-9593-9a19354c4fa0';
    const Bostandyk = '8e1b724b-11a3-4e61-9937-c8b4bf25aa44';
    const Zhetisu = 'c661dde6-793c-4658-a97f-5c581d1cf472';
    const Medeu = '6d8b187d-440d-415d-8cfb-8ff7cc42f0bb';
    const Nauryz = '5f82d4d4-c276-4ecd-af9c-fdcdefc8ce4b';
    const Turksyb = 'b5b54335-2a9c-4660-ae5e-c53622b2c790';

    public const DistrisctsList = [
        self::Alatau    => 'Алатауский',
        self::Almaly    => 'Алмалинский',
        self::Auezov    => 'Ауэзовский',
        self::Bostandyk    => 'Бостандыкский',
        self::Zhetisu    => 'Жетысуский',
        self::Medeu    => 'Медеуский',
        self::Nauryz    => 'Наурызбайский',
        self::Turksyb    => 'Турксибский',
    ];
}
