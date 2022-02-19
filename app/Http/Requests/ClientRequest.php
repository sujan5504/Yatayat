<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'email' => [
                'required','max:250',
                Rule::unique('clients')->where(function ($query) {
                    $query->where('id', '!=', request()->id);
                })
            ],
            'contact' => 'required|max:14',
            'is_active' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => trans('client.name'),
            'is_active' => trans('client.is_active'),
            'email' => trans('client.email'),
            'contact' => trans('client.contact'),
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute is a required field.',
            'max' => 'Max value for :attribute field is 250.',
            'unique' => 'The value you entered for :attribute field has already been taken.',
        ];
    }
}
