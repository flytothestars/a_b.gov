<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
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
            'file'        => 'required|mimes:jpg,png',
            'createDate'  => 'required|date_format:Y-m-d',
            'categoryId'  => 'required|uuid|exists:news_categories,id',
            'isPublished' => 'boolean',
            'headerRu'    => 'required|string|unique:news,header',
            'leadRu'      => 'required|string',
            'contentRu'   => 'required|string',
            'headerKk'    => 'required|string',
            'leadKk'      => 'required|string',
            'contentKk'   => 'required|string',
        ];
    }
}
