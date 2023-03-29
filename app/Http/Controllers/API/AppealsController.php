<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppealHistoryResource;
use App\Repositories\IAppealHistoryRepository;
use App\Repositories\IAppealRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class AppealsController extends Controller
{
    private $appealRepository;
    private $appealHistoryRepository;


    public function __construct(IAppealRepository $appealRepository,
        IAppealHistoryRepository $appealHistoryRepository)
    {
        $this->appealRepository = $appealRepository;
        $this->appealHistoryRepository = $appealHistoryRepository;
    }

    public function index() : JsonResource
    {
        return new JsonResource($this->appealRepository->all()) ;
    }

    public function history($id) : JsonResource
    {
        return AppealHistoryResource::collection($this->appealHistoryRepository->getByAppeal($id)) ;
    }

    public function historyAll($id) : JsonResource
    {
        return AppealHistoryResource::collection($this->appealHistoryRepository->getByAppealAll($id)) ;
    }

}
