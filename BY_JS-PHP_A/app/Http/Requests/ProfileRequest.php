<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            //
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'username'=>'required|max:255',
            'password'=>'required',
            'email'=>'required|max:255',
            'linkedin_url'=>'sometimes|url|max:255',
            'gender'=>'in:male,female',
            'age'=>'required|max:130|min:5|integer'
        ];
    }
}
