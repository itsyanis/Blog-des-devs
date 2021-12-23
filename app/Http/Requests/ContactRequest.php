<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:255',
            'phoneNumber' => 'nullable|string|min:9|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'subject' => 'required|string|min:4|max:255',
            'message' => 'required|string|min:8|',        
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Veuillez introduir votre prénom',
           // 'first_name.string' => 'Ce champs doit contenir une chaine de caractère',
        ];
    }
}
