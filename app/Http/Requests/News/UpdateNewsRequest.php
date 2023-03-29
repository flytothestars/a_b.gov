<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'          => 'required|uuid|exists:news,id',
            'fileChanged' => 'boolean',
            'file'        => 'mimes:jpg,png',
            'createDate'  => 'required|date_format:Y-m-d',
            'categoryId'  => 'required|uuid|exists:news_categories,id',
            'isPublished' => 'boolean',
            'headerRu'    => 'string',
            'leadRu'      => 'string',
            'contentRu'   => 'string',
            'headerKk'    => 'string',
            'leadKk'      => 'string',
            'contentKk'   => 'string',
        ];
    }
}
