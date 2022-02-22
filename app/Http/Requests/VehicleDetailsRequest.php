<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VehicleDetailsRequest extends FormRequest
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
            'vehicle_id' => 'required',
            'vehicle_type_id' => 'required',
            'vehicle_number' => 'required|max:20',
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
            'vehicle_id' => trans('vehicleDetail.vehicle'),
            'vehicle_type_id' => trans('vehicleDetail.vehicle_type'),
            'vehicle_number' => trans('vehicleDetail.vehicle_number'),
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
        ];
    }
}
