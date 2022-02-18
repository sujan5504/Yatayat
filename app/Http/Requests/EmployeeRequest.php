<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $rules = [
            'full_name' => 'required|max:250',
            'employee_type_id' => 'required',
            'contact' => 'required|max:20',
            'gender_id' => 'required',
            'is_active' => 'required',
            'license_number' => 'unique:employees,license_number'.$id_check,
        ];
        if (request()->employee_type_id == 1) {
            $rules['license_number'] = 'required|unique:employees,license_number'.$id_check;
            $rules['issued_date_bs'] = 'required|max:10';
            $rules['issued_date_ad'] = 'required';
        }
        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => trans('employee.first_name'),
            'last_name' => trans('employee.last_name'),
            'employee_type_id' => trans('employee.employee_type'),
            'contact' => trans('employee.contact'),
            'gender_id' => trans('employee.gender'),
            'is_active' => trans('employee.is_active'),
            'license_number' => trans('employee.license_number'),
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
