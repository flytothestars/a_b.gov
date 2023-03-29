<?php


namespace Database\Seeders;


use App\Models\Appeal;
use Illuminate\Database\Seeder;

class ClearAppeals extends Seeder
{
    public function run(): void
    {
        Appeal::query()->delete();
    }
}
