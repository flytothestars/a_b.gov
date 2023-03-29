<?php


namespace App\Repositories;


use App\Models\ServiceBanks;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ServiceBanksRepository extends BaseRepository implements IServiceBanksRepository
{
    public function __construct(ServiceBanks $model)
    {
        parent::__construct($model);
    }

    public function getById($bankID)
    {
        $model = $this->model;
        $model = $model->where('id', $bankID);

        if ($this->isTranslatebale)
            $model = $model->with("translations");


        return $model->first();
    }
    public function all(): Collection
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        return $model->get();
    }
    public function getAllToAccount()
    {
        $model = $this->model;
        $model = $model->select(
            'id',
            'bank_code',
            'header',
            'open_account as paragraph1',
            'account_price as paragraph2',
            'account_managment as paragraph3',
            'open_account_url as url'
        )/*->whereIn('bank_code', ['alfa', 'sber'])*/;
        if ($this->isTranslatebale)
            $model = $model->with("translations");
        return $model->get();
    }

    public function getAllToLoan()
    {
        $model = $this->model;
        $model = $model->select(
            'id',
            'bank_code',
            'header',
            'application as paragraph1',
            'rate as paragraph2',
            'term as paragraph3',
            'get_loan_url as url'
        )/*->whereIn('bank_code', ['alfa', 'sber'])*/;
        if ($this->isTranslatebale)
            $model = $model->with("translations");
        return $model->get();
    }



    public function getToAccount($bankID)
    {
        $model = $this->model;
        $model = $model->select(
            'id',
            'bank_code',
            'header',
            'account_content as content',
            'open_account_url as url'
        );
        $model = $model->where('id', $bankID);

        if ($this->isTranslatebale)
            $model = $model->with("translations");


        return $model->first();
    }
    public function getToLoan($bankID)
    {
        $model = $this->model;
        $model = $model->select(
            'id',
            'bank_code',
            'header',
            'loan_content as content',
            'get_loan_url as url'
        );
        $model = $model->where('id', $bankID);

        if ($this->isTranslatebale)
            $model = $model->with("translations");


        return $model->first();
    }
}
