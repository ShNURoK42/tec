<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Правила валидации для файла.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'mimes:csv,txt', 'max:2048'],
        ];
    }

    /**
     * Наименование атрибутов.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'file' => 'файл',
        ];
    }
}
