<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmAppealRequest extends FormRequest
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

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment' => 'nullable|string',
            'files.*' => 'mimetypes:' . implode(',',$this->mimeTypes),
        ];
    }

    public function messages()
    {
        return [
            'files.*.mimetypes' => [ 'Файлы должны быть изображениями, документами word/pdf или архивами' ]
        ];
    }
}
