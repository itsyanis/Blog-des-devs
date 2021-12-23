<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'author' => 'required|string|min:2|max:80',
            'comment' => 'required|string|min:4|max:800',
        ];
    }

    public function messages()
    {
        return [
          'author.required' => 'Veuillez introduir votre nom.',
          'author.string' => 'Le champ nom doit contenir une chaine de caractères.',
          'author.min' => 'Le champ nom doit contenir au minimum 2 caractères.',
          'author.max' => 'Le champ nom contenir au maximum 80 caractères.',

          'comment.required' => 'Veuillez saisir un commentaire.',
          'comment.string' => 'Le commentaire doit contenir une chaine de caractères.',
          'comment.min' => 'Le commentaire doit contenir au minimum 4 caractères.',
          'comment.max' => 'Le commentaire contenir au maximum 800 caractères.',
        ];
    }
}
