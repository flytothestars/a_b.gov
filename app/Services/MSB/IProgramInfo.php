<?php

namespace App\Services\MSB;

use Illuminate\Contracts\Support\Arrayable;

interface IProgramInfo extends Arrayable
{
    public const ProgramName              = 'name';                 // Название программы
    public const ProgramTargetSegmentType = 'target_segment_type';  // ??
    public const ProgramTargetSegmentSize = 'target_segment_size';  // ??
    public const ProgramMaxAmount         = 'max_amount';           // Максимальная сумма финансирования
    public const ProgramMinAmount         = 'min_amount';           // Минимальная сумма финансирования
    public const ProgramTarget            = 'target';               // Цель займа
    public const ProgramDescription       = 'description';          // Подробная информация о программе
    public const ProgramPeriod            = 'period';               // Процентная ставка
    public const ProgramDeadline          = 'deadline';             // Срок займа
    public const ProgramOwner             = 'owner';                // Оператор программы
    public const ProgramPartners          = 'partners';             // Список партнеров
    public const ProgramType              = 'program_type';         // Тип программы
    public const ProgramId                = 'id';                   // Идентификатор программы
    public const ProgramAllActivities     = 'all_activities';       // ??
    public const ProgramAllRegions        = 'all_regions';          // ??

    public function getOwnerLogoUrl(): string;

    public function getOwnerName(): string;

    public function getOwnerId(): int;

    public function getProgramType(): string;

    public function getProgramId(): ?int;

    /**
     * @return IPartnerInfo[]
     */
    public function getPartners(): array;


}
