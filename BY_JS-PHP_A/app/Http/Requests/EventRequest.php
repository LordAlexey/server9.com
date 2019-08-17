<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title'=>'required|max:255',
            'description'=>'required',
            'date'=>'required|date',
            'time'=>'required|max:10',
            'duration_days'=>'required|min:0|max:99999|integer',
            'location'=>'required|max:255',
            'standard_price'=>'required|min:0|numeric',
            'capacity'=>'required|min:0|integer',

            'sessions.*.title'=>'required|max:255',
            'sessions.*.room'=>'required|max:255',
            'sessions.*.speaker'=>'required|max:255',
        ];
    }
}
