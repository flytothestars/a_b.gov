<?php

namespace App\Http\Controllers\API\UserReport;

use App\Contracts\IDayOfWeek;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserReport\UserReportRequest;
use App\Models\AuthenticationLog;
use App\Models\User;
use App\Repositories\Enums\RoleIntEnum;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    final public function getUserReport(UserReportRequest $userReportRequest): JsonResponse
    {
        $attributes = $userReportRequest->validated();
        $date       = $attributes[ 'date' ]
                      ??
                      Carbon::now()
                            ->format('Y-m-d')
        ;

        $endDate          = Carbon::createFromFormat('Y-m-d', $date);
        $startDateWeek    = $endDate
            ->clone()
            ->subDays(6)
        ;
        $startDateWeekStr = $startDateWeek->format('Y-m-d');

        $startDateMonth    = $endDate
            ->clone()
            ->day(1)
        ;
        $startDateMonthStr = $startDateMonth->format('Y-m-d');

        return response()->json(
            [
                'registeredToday'  => $this->getTodayRegisteredCommonUsers($date),
                'activeToday'      => $this->getTodayActiveCommonUsers($date),
                'registeredWeek'   => $this->getWeekRegisteredCommonUsers($startDateWeekStr, $date),
                'activeWeek'       => $this->getWeekActiveCommonUsers($startDateWeekStr, $date),
                'registeredMonths' => $this->getMonthsRegisteredCommonUsers($startDateMonthStr, $date),
                'activeMonths'     => $this->getMonthActiveCommonUsers($startDateMonthStr, $date),
            ]
        );

    }

    private function getWeekRegisteredCommonUsers(string $startDate, string $endDate): array
    {
        $usersDates = User
            ::where('created_at', '>=', "$startDate 00:00:00")
            ->where('created_at', '<=', "$endDate 23:59:59")
            ->where(
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->get()
            ->map(
                function ($item)
                {
                    $user                 = $item->toArray();
                    $dayOfWeek            = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->dayOfWeek;
                    $user[ 'created_at' ] = IDayOfWeek::Name[ $dayOfWeek ];
                    return $user;
                }
            )
        ;

        $dates = $this->fillWeekDates($startDate);

        foreach ($usersDates as $user) {
            ++$dates[ $user[ 'created_at' ] ];
        }

        return $this->formatData($dates);
    }

    private function getMonthsRegisteredCommonUsers(string $startDate, string $endDate): array
    {
        $usersDates = User
            ::where('created_at', '>=', "$startDate 00:00:00")
            ->where('created_at', '<=', "$endDate 23:59:59")
            ->where(
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->get()
            ->map(
                function ($item)
                {
                    $user = $item->toArray();

                    $user[ 'created_at' ] = Carbon
                        ::createFromFormat('Y-m-d H:i:s', $item->created_at)
                        ->format('Y-m-d')
                    ;
                    return $user;
                }
            )
        ;

        $dates = [
            $startDate => 0,
            $endDate => 0,
        ];

        foreach ($usersDates as $user) {
            if (!isset($dates[ $user[ 'created_at' ] ])) {
                $dates[ $user[ 'created_at' ] ] = 0;
            }
            ++$dates[ $user[ 'created_at' ] ];
        }

        return $this->formatData($dates);
    }

    private function getTodayRegisteredCommonUsers(string $date): ?int
    {
        return User
            ::where('created_at', '>=', "$date 00:00:00")
            ->where('created_at', '<=', "$date 23:59:59")
            ->where(
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->count()
            ;
    }

    private function getWeekActiveCommonUsers(string $startDate, string $endDate): array
    {
        $authsDates = AuthenticationLog
            ::where('login_successful', true)
            ->with('user')
            ->where('login_at', '>=', "$startDate 00:00:00")
            ->where('login_at', '<=', "$endDate 23:59:59")
            ->whereHas(
                'user',
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->get()
            ->map(
                function ($item)
                {
                    $user                 = $item->authenticatable->toArray();
                    $dayOfWeek            = Carbon::createFromFormat('Y-m-d H:i:s', $item->login_at)->dayOfWeek;
                    $user[ 'created_at' ] = IDayOfWeek::Name[ $dayOfWeek ];
                    return $user;
                }
            )
        ;

        $dates    = $this->fillWeekDates($startDate);
        $usersIds = [];

        foreach ($authsDates as $user) {
            if (!in_array($user[ 'id' ], $usersIds, true)) {
                ++$dates[ $user[ 'created_at' ] ];
                $usersIds[] = $user[ 'id' ];
            }
        }

        return $this->formatData($dates);
    }

    private function getMonthActiveCommonUsers(string $startDate, string $endDate): array
    {
        $authsDates = AuthenticationLog
            ::where('login_successful', true)
            ->with('user')
            ->where('login_at', '>=', "$startDate 00:00:00")
            ->where('login_at', '<=', "$endDate 23:59:59")
            ->whereHas(
                'user',
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->get()
            ->map(
                function ($item)
                {
                    $user = $item->authenticatable->toArray();

                    $user[ 'created_at' ] = Carbon
                        ::createFromFormat('Y-m-d H:i:s', $item->login_at)
                        ->format('Y-m-d')
                    ;
                    return $user;
                }
            )
        ;

        $dates    = [
            $startDate => 0,
            $endDate => 0,
        ];
        $usersIds = [];

        foreach ($authsDates as $user) {
            if (!isset($dates[ $user[ 'created_at' ] ])) {
                $dates[ $user[ 'created_at' ] ] = 0;
            }
            if (
            isset($usersIds[ $user[ 'created_at' ] ])
            ) {
                if (!in_array($user[ 'id' ], $usersIds[ $user[ 'created_at' ] ], true)) {
                    ++$dates[ $user[ 'created_at' ] ];
                    $usersIds[ $user[ 'created_at' ] ][] = $user[ 'id' ];
                }
            } else {
                ++$dates[ $user[ 'created_at' ] ];
                $usersIds[ $user[ 'created_at' ] ][] = $user[ 'id' ];
            }
        }

        return $this->formatData($dates);
    }

    private function getTodayActiveCommonUsers(string $date): ?int
    {
        return AuthenticationLog
            ::where('login_successful', true)
            ->with('user')
            ->where('login_at', '>=', "$date 00:00:00")
            ->where('login_at', '<=', "$date 23:59:59")
            ->whereHas(
                'user',
                function ($query)
                {
                    $query
                        ->whereHas(
                            'roles',
                            function ($query)
                            {
                                $query->where('id', RoleIntEnum::Client);
                            }
                        )
                        ->orDoesntHave('roles')
                    ;
                }
            )
            ->get()
            ->count()
            ;
    }

    private function fillWeekDates(string $startDate): array
    {
        $dates         = [];
        $day           = 0;
        $iterationDate = Carbon::createFromFormat('Y-m-d', $startDate);

        while ($day < 7) {
            if (!isset($dates[ IDayOfWeek::Name[ $iterationDate->dayOfWeek ] ])) {
                $dates[ IDayOfWeek::Name[ $iterationDate->dayOfWeek ] ] = 0;
            }

            $iterationDate->addDay();

            $day++;
        }

        return $dates;
    }

    private function formatData(array $data): array
    {
        $formatted = [];

        foreach ($data as $day => $count) {
            $formatted[] = [
                'day'   => $day,
                'count' => $count,
            ];
        }

        return $formatted;
    }
}
