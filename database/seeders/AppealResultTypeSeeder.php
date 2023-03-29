<?php

namespace Database\Seeders;

use App\Models\AppealResultType;
use App\Repositories\Enums\AppealResultTypeEnum;
use Illuminate\Database\Seeder;

class AppealResultTypeSeeder extends Seeder
{
    public function run()
    {
        $statusList = [
            ['id' => AppealResultTypeEnum::CompletedByPhone, 'name' => 'Вопрос решен по телефону'],
            ['id' => AppealResultTypeEnum::ClientNoAnswer, 'name' => 'Не удалось дозвониться'],
            ['id' => AppealResultTypeEnum::WrongContact, 'name' => 'Контакт не принадлежит заявителю'],
            ['id' => AppealResultTypeEnum::NotActual, 'name' => 'Обращение не актуально'],
            ['id' => AppealResultTypeEnum::CompletedWithoutQoldau, 'name' => 'Вопрос решен без участия Колдау'],
            ['id' => AppealResultTypeEnum::CompletedInQoldauOffice, 'name' => 'Вопрос решен в офисе Колдау'],
            ['id' => AppealResultTypeEnum::ClientDidNotComeToConsultation, 'name' => 'Заявитель не пришел на консультацию'],
            ['id' => AppealResultTypeEnum::CompletedByCoExecutor, 'name' => 'Вопрос решен с участием соисполнителя'],
            ['id' => AppealResultTypeEnum::ClientDoesNotGetInTouch, 'name' => 'Заявитель не выходит на связь'],
            ['id' => AppealResultTypeEnum::CompletedByClient, 'name' => 'Вопрос решен заявителем самостоятельно'],
            ['id' => AppealResultTypeEnum::Completed, 'name' => 'Проблема решена'],
            ['id' => AppealResultTypeEnum::NoLegalBasic, 'name' => 'Не имеет законное обосновани'],
            ['id' => AppealResultTypeEnum::OutOfCompetence, 'name' => 'Вне компетенции'],
        ];

        foreach ($statusList as $status) {
            AppealResultType::query()->updateOrCreate(
                ['id' => $status['id']],
                [
                'id' => $status['id'],
                'name' => $status['name']
            ]);
        }
    }
}
