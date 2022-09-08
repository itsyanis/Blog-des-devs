<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'    => 'required|string|min:4|max:255',
            'subtitle' => 'nullable|string|min:2|max:120',
            'category' => 'required|integer|exists:categories,id',
            'tags'     => 'required|string|min:2|max:100',
            'content'  => 'required|string|min:8'
        ];
    }


    public function messages()
    {
        return [
          'title.required' => 'Veuillez entrer le titre de l\'article.',
          'title.string'   => 'Le titre de l\'article doit etre une chaine de caracteres.',
          'title.min'      => 'Le titre de l\'article doit contenir au minimum 04 caratères.',
          'title.max'      => 'Le titre de l\'article doit contenir au maximum 255 caratères.',

          'subtitle.required' => 'Veuillez donner un sous-titre à l\'article.',
          'subtitle.string'   => 'Le sous-titre de l\'article doit etre une chaine de caracteres.',
          'subtitle.min'      => 'Le sous-titre de l\'article doit contenir au minimum 02 caratères.',
          'subtitle.max'      => 'Le sous-titre de l\'article doit contenir au maximum 120 caratères.',

          'category.required' => 'Veuillez choisir une catégorie.',
          'category.integer'  => 'Veuillez choisir une catégorie présente dans la séléction.',
          'category.exists'   => 'Veuillez choisir une catégorie présente dans la séléction.',

          'tags.required' => 'Veuillez entrer des tags (thème) à l\'article.',
          'tags.string'   => 'Les tags de l\'article doivent etre une chaine de caracteres.',
          'tags.min'      => 'Les tags de l\'article doivent contenir au minimum 02 caratères.',
          'tags.min'      => 'Les tags de l\'article doivent contenir au maximum 100 caratères.',

          'content.required' => 'Veuillez écrire votre contenu.',
          'content.string'   => 'Le contenu de l\'article doit etre une chaine de caracteres.',
          'content.min'      =>  'Le contenu de l\'article doit contenir au minimum 10 caratères.',
        ];
    }
}
