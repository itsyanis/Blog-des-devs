<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required|mimes:jpg,jpeg,png,webp,gif,svg|max:8000',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Veuillez déposer une image.',
            'file.mimes' => 'Veuillez réspecter le format : jpg,jpeg,png,webp,gif,svg.',
            'file.max' => 'La taille de l\'image ne doit pas dépasser 8 MO.',


        ];
    }
}
