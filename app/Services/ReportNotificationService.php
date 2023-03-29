<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\TelegramReportSyncNotification;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class ReportNotificationService implements IReportNotificationService
{

    private function getUsers(): Collection
    {
        $role = RoleIntEnum::Administrator;
        return User
            ::whereHas(
                'roles',
                function ($q) use ($role)
                {
                    $q->where('role_id', $role);
                }
            )
            ->whereNotNull('telegram_user_id')
            ->get()
            ;
    }

    final public function sendMessage(string $message): void
    {
        Notification::send($this->getUsers(), new TelegramReportSyncNotification($message));
    }


}
