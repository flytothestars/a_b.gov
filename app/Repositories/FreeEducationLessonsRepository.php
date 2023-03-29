<?php


namespace App\Repositories;


use App\Models\FreeEducationLessons;

class FreeEducationLessonsRepository extends BaseRepository implements IFreeEducationLessonsRepository
{
    public function __construct(FreeEducationLessons $model)
    {
        parent::__construct($model);
    }
}
