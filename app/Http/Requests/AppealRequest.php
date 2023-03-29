<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AppealRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        $rules = [
            'per_page' => '',
            'page' => '',
            'sortBy' => '',
            'sortDesc' => '',
        ];

        switch ($this->getMethod())
        {
            case 'GET':
                return[
                        'from_date' => 'nullable|beforeOrEqual:to_date',
                        'to_date' => 'nullable',
                        'category_id' => 'nullable',
                        'type_id' => 'nullable|uuid:exists:category_appeals,type_id',
                        'district_id' => 'nullable|uuid:exists:district,id',
                        'executor_id' => 'nullable|numeric:exists:users,id',
                        'co_executor_id' => 'nullable|numeric:exists:users,id',
                        'distributor_id' => 'nullable|numeric:exists:users,id',
                        'last_curator_upi_id' => 'nullable|numeric:exists:users,id',
                        'last_curator_district_id' => 'nullable|numeric:exists:users,id',
                        'appeal_result_type_id' => 'nullable|uuid:exists:appeal_result_types,id',
                        'appeal_status_id' => 'nullable|uuid:exists:appeal_statuses,id',
                        'client_appeal_status_id' => 'nullable|uuid:exists:client_appeal_statuses,id',
                        'source_type_id' => 'nullable|uuid:exists:source_type,id',
                        'isIn_Upi' => 'nullable',
                        'start_date' => 'nullable',
                        'end_date' => 'nullable',
                        'start_date_updated' => 'nullable',
                        'end_date_updated' => 'nullable',
                        'iin' => 'nullable',
                        'per_page' => 'nullable',
                        'page'=>'nullable',
                        'appeal_status'=>'nullable',
                    ] + $rules;
            case 'POST':

                return[
                        'content' => 'string',
                        'category_id' => 'required',
                        'file' => '',
                        'file1' => '',
                        'file2' => '',
                        'file3' => '',
                        'file4' => '',
                        'file5' => '',
                        'file6' => '',
                        'file7' => '',
                        'file8' => '',
                        'file9' => '',
                        'file10' => '',
                        'file11' => '',
                        'file12' => '',
                        'file13' => '',
                    ] + $rules;
            case 'PUT':
                return [
                        'id' => 'required|uuid|exists:appeals,id',
                        'content' => 'nullable|string',
                        'category_id' => 'nullable|uuid:exists:service_groups,id',
                        'type_id' => 'nullable|uuid:exists:category_appeals,id'
                    ] + $rules;
        }

        return $rules;
    }

}