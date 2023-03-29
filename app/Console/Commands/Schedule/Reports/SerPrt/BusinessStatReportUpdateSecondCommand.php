<?php

namespace App\Console\Commands\Schedule\Reports\SerPrt;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\City;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Services\IReportNotificationService;
use App\Services\TaldauApiReports\LoadOrUpdateNumberRatioByYears;
use Exception;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Console\Command;

class BusinessStatReportUpdateSecondCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:ser-prt-business-stat-second';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch business stat report';

    private LoadOrUpdateNumberRatioByYears $loader;
    private IReportNotificationService     $messenger;

    /**
     * BusinessStatReportUpdateCommand constructor.
     *
     * @param LoadOrUpdateNumberRatioByYears $loader
     * @param IReportNotificationService     $messenger
     */
    public function __construct(LoadOrUpdateNumberRatioByYears $loader, IReportNotificationService $messenger)
    {
        $this->loader    = $loader;
        $this->messenger = $messenger;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    final public function handle(): int
    {
        $ratios = TaldauApiUrl
            ::where(
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID,
                IReportTypeEnum::ReportBusinessStatistics
            )
            ->where(ITaldauApiUrlContract::FIELD_IS_ACTIVE, true)
            ->whereIn(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IBusinessStatisticsRatioEnum::SecondPartRatios)
            ->get()
        ;

        $city = City
            ::all()
            ->first()->id
        ;

        $bar = $this->output->createProgressBar($ratios->count());
        $this->messenger->sendMessage(
            'Импорт данных для отчета'
            . ' _Статистика предприятий часть 2_ - Начат'
            . "\nПоказателей: {$ratios->count()}"
        );

        foreach ($ratios as $ratio) {
            $bar->advance();

            try {
                $this->loader->loadOrUpdateCityRatio(
                    $city,
                    $ratio->report_type_id,
                    $ratio->report_ratio_id
                );
            } catch (Exception $exception) {
                try {
                    sleep(3);
                    $this->loader->loadOrUpdateCityRatio(
                        $city,
                        $ratio->report_type_id,
                        $ratio->report_ratio_id
                    );
                } catch (Exception $exception) {
                    sleep(3);

                    try {
                        $this->loader->loadOrUpdateCityRatio(
                            $city,
                            $ratio->report_type_id,
                            $ratio->report_ratio_id
                        );
                    } catch (Exception $exception) {
                        $this->messenger->sendMessage(
                            'Импорт данных для отчета'
                            . ' _Статистика предприятий часть 2_ - Ошибка импорта! '
                            . "\n\n{$exception->getMessage()}"
                        );

                        throw $exception;
                    }

                }
            }

            sleep(2);

        }

        $bar->finish();
        $this->info('');

        $this->messenger->sendMessage(
            'Импорт данных для отчета'
            . ' _Статистика предприятий часть 2_ - Завершен '
        );

        return 0;
    }

}
