<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppealByParentRequest extends FormRequest
{

    private $mimeTypes = [
        'image/png',
        'image/jpeg',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/zip',
        'application/x-zip-compressed',
        'application/pdf',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
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
            'parent_appeal_id' => ['required','exists:appeals,id'],
            'type_id' => [],
            'category_id' => ['required','exists:service_groups,id'],
            'content' =>[ 'required', 'min:10', 'string' ],
            'files.*' => ['mimetypes:' . implode(',',$this->mimeTypes)],
        ];
    }

    public function messages()
    {
        return [
            'files.*.mimetypes' => [ 'Файлы должны быть изображениями, документами word/pdf или архивами' ]
        ];
    }


}
