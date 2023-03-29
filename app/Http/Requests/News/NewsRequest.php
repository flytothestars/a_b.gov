<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'per_page' => '',
            'page'     => '',
            'sortBy'   => '',
            'sortDesc' => '',
        ];

        switch ($this->getMethod()) {
            case 'GET':
                return [
                           'from_date'        => 'nullable|beforeOrEqual:to_date',
                           'to_date'          => 'nullable',
                           'news_category_id' => 'nullable|uuid:exists:news_categories,id',
                           'header'           => 'nullable|string|max:1024',
                           'lead'             => 'nullable|string|max:1024',
                           'content'          => 'nullable|string',
                           'is_published'     => 'nullable|boolean',
                           'code'             => 'nullable|string',
                           'date_format'      => 'nullable|date_format:Y-m-d',
                       ] + $rules;
            case 'POST':

                return [
                           'news_category_id' => 'uuid:exists:news_categories,id',
                           'header'           => 'string|max:1024',
                           'lead'             => 'string|max:1024',
                           'content'          => 'string',
                           'is_published'     => 'string',
                           'code'             => 'boolean',
                           'date_format'      => 'date_format:Y-m-d',
                           'files'            => '',
                       ] + $rules;
            case 'PUT':
                return [
                           'news_category_id' => 'required|uuid:exists:news_categories,id',
                           'header'           => 'required|string|max:1024',
                           'lead'             => 'required|string|max:1024',
                           'content'          => 'required|string',
                           'is_published'     => 'required|string',
                           'code'             => 'required|boolean',
                           'date_format'      => 'required|date_format:Y-m-d',
                       ] + $rules;
        }

        return $rules;
    }

}
