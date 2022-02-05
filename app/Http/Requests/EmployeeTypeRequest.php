<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeTypeRequest extends FormRequest
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
        $id_check = $this->request->get('id') ? ",".$this->request->get('id') : "";
        return [
            'name' => 'required|max:250|unique:employee_types,name'.$id_check,
            'is_active' => 'required',
            'remarks' => 'max:500',
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
            'name' => trans('common.name'),
            'is_active' => trans('common.is_active'),
            'remarks' => trans('common.remarks'),
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
