<?php

namespace App\Http\Requests;

use App\Models\Act;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ActRequest extends FormRequest
{
    /**
     * Determine if the BiddingModality is authorized to make this request.
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
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
