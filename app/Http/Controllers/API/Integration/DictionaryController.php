<?php

namespace App\Http\Controllers\API\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Integration\BusinessRequest;
use App\Http\Resources\DictResource;
use App\Repositories\IAppealResultTypeRepository;
use App\Repositories\Integration\IAppealRepository;
use App\Repositories\ISourceRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryController extends Controller
{
    private ISourceRepository $sourceRepository;
    private IAppealResultTypeRepository $appealResultTypeRepository;

    public function __construct(
        ISourceRepository $sourceRepository,
        IAppealResultTypeRepository $appealResultTypeRepository
    )
    {
        $this->sourceRepository = $sourceRepository;
        $this->appealResultTypeRepository = $appealResultTypeRepository;
    }

    public function sourceType(): JsonResource
    {
        return DictResource::collection($this->sourceRepository
            ->all());
    }

    public function appealResultType(): JsonResource
    {
        return DictResource::collection($this->appealResultTypeRepository
            ->all());
    }
}


