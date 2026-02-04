<?php

namespace App\Http\Requests;

use App\Models\SensitiveInformationResponsible;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SensitiveInformationResponsibleRequest extends FormRequest
{
    /**
     * Determine if the Project is authorized to make this request.
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
            'name'          => [
                'required',
                'min:3',
                'max:150'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name'                    => 'Nome',
        ];
    }
}
