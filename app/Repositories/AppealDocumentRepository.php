<?php


namespace App\Repositories;


use App\Models\AppealDocument;
use App\Models\BusinessPhoto;
use App\Repositories\Enums\DocumentSourceTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AppealDocumentRepository extends BaseRepository implements IAppealDocumentRepository
{
    public function __construct(AppealDocument $model)
    {
        parent::__construct($model);
    }


    public function createClientDocument($appealId, $file): ?Model
    {
        if(!$file)
            return null;

        $attributes = [
            'id' => Uuid::uuid4(),
            'appeal_id' => $appealId,
            'document_source_type_id' => DocumentSourceTypeEnum::ClientDocument,
            'created_by' => Auth::user()->id,
            'description' => $file->getClientOriginalName()
        ];

        $entity = parent::create($attributes);
        $this->persistStorageFile($entity->id, $file, 'appeals/' . $entity->id . '/clientDocuments', "");

        return $this->find($entity->id);
    }

    public function createManagerDocument($appealId, $file): ?Model
    {
        if(!$file)
            return null;

        $attributes = [
            'id' => Uuid::uuid4(),
            'appeal_id' => $appealId,
            'document_source_type_id' => DocumentSourceTypeEnum::ManagerDocument,
            'created_by' => Auth::user()->id,
            'description' => $file->getClientOriginalName()
        ];

        $entity = parent::create($attributes);
        $this->persistStorageFile($entity->id, $file, 'appeals/' . $entity->id . '/managerDocuments', "");

        return $this->find($entity->id);
    }

}
