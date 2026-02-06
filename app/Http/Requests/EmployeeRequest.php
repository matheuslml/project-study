<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the Employee is authorized to make this request. 
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
            'registry'    => [
            ],
            'person_id'    => [
                Rule::exists(Person::class, 'id')
            ],
            'departament_id'    => [
                Rule::exists(Person::class, 'id')
            ],
        ];
    }
    
    public function attributes()
    {
        return [
            'registry'                 => 'registro',
            'person_id'                 => 'pessoa',
            'departament_id'                 => 'departamento',
        ];
    }
}
