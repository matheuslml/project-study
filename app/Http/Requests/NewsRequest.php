<?php

namespace App\Http\Requests;

use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the News is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return Auth::user()->isEmployee() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title'          => [
                'required'
            ],
            'image'          => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'title'                    => 'Título',
            'image'                    => 'Thumb',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'É obrigatório colocar um Título.',
            'image.required' => 'É obrigatório colocar uma Thumb.',
            'image.image' => 'tem que ser uma imagem',
            'image.mimes' => 'A imagem tem que estar em um desses formatos: jpeg,png,jpg,gif,svg',
            'image.max' => 'Tamanho máximo do arquivo 2048',
        ];
    }
}
