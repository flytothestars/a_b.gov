<?php

namespace App\Http\Controllers\API\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Telegram\CreateAppealRequest;
use App\Http\Requests\API\Telegram\FillProfileRequest;
use App\Http\Requests\API\Telegram\GetAppealsRequest;
use App\Http\Requests\API\Telegram\ListAppealsRequest;
use App\Models\User;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\SourceTypeEnum;
use App\Repositories\IAppealDocumentRepository;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealRepository;
use App\Repositories\IProfileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TelegramController extends Controller
{
    private IProfileRepository              $profileRepository;
    private IAppealRepository               $appealRepository;
    private IAppealDocumentRepository       $appealDocumentRepository;
    private IAppealForDistributorRepository $appealForDistributorRepository;

    /**
     * TelegramController constructor.
     *
     * @param IProfileRepository              $profileRepository
     * @param IAppealRepository               $appealRepository
     * @param IAppealDocumentRepository       $appealDocumentRepository
     * @param IAppealForDistributorRepository $appealForDistributorRepository
     */
    public function __construct(
        IProfileRepository $profileRepository,
        IAppealRepository $appealRepository,
        IAppealDocumentRepository $appealDocumentRepository,
        IAppealForDistributorRepository $appealForDistributorRepository
    )
    {
        $this->profileRepository              = $profileRepository;
        $this->appealRepository               = $appealRepository;
        $this->appealDocumentRepository       = $appealDocumentRepository;
        $this->appealForDistributorRepository = $appealForDistributorRepository;
    }


    final public function fillProfile(FillProfileRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user = User
            ::where('telegram_user_id', $attributes[ 'telegram-user-id' ])
            ->first()
        ;

        $profile = $user->profile;

        $this->profileRepository->update($profile->id, $attributes);
        $name = $request->validated()[ 'last_name' ]
                . ' '
                . $request->validated()[ 'first_name' ]
                . ' '
                . $request->validated()[ 'second_name' ];

        $user->name  = $name;
        $user->email = $request->validated()[ 'email' ];
        $user->update();

        return response()->json([ 'user_id' => $user->id ]);
    }

    final public function createAppeal(CreateAppealRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user    = User
            ::where('telegram_user_id', $attributes[ 'telegram-user-id' ])
            ->first()
        ;
        $profile = $user->profile;

        $attributes = $request->validated() +
                      [
                          'client_appeal_status_id' => ClientAppealStatusEnum::Pending,
                          'appeal_status_id'        => AppealStatusEnum::Pending,
                          'user_id'                 => $profile->user_id,
                          'source_type_id'          => SourceTypeEnum::Portal,
                      ];

        DB::beginTransaction();

        $appeal_new = $this->appealRepository->create($attributes);

        if (array_key_exists('file', $attributes)) {
            foreach ($attributes[ 'file' ] as $file) {
                $this->appealDocumentRepository->createClientDocument($appeal_new->id, $file);
            }
        }

        if ($appeal_new->client_appeal_status_id == ClientAppealStatusEnum::Pending) {
            $this->appealForDistributorRepository->autoAssignDistributor($appeal_new->id);
        }

        DB::commit();

        return response()->json([ 'appeal_id' => $appeal_new->id ]);
    }

    final public function activeAppealList(ListAppealsRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user = User
            ::where('telegram_user_id', $attributes[ 'telegram-user-id' ])
            ->first()
        ;

        if ($user) {
            $appeals = $this
                ->appealRepository
                ->getAllAppealsByUserId($user->id)
                ->toArray()
            ;
        } else {
            $appeals = [];
        }

        return response()->json($appeals);
    }

    final public function appealInfo(GetAppealsRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $user = User
            ::where('telegram_user_id', $attributes[ 'telegram-user-id' ])
            ->first()
        ;

        if ($user) {
            $appeals = $this
                ->appealRepository
                ->getAppealById($attributes['appeal-id'])
                ->toArray()
            ;
        } else {
            $appeals = [];
        }

        return response()->json($appeals);
    }

}
