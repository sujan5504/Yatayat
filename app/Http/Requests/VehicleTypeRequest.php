<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'vehicle_id' => 'required',
            'total_no_of_seat' => 'required',
        ];

        if (request()->is_seat_details_required) {
            $rules['driver_side'] = 'required';
            $rules['last_row'] = 'required';
            $rules['right_row'] = 'required';
            $rules['right_column'] = 'required';
            $rules['left_row'] = 'required';
            $rules['left_column'] = 'required';
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
            'name' => trans('vehicleType.name'),
            'vehicle_id' => trans('vehicleType.vehicle_id'),
            'driver_side' => trans('vehicleType.driver_side'),
            'last_row' => trans('vehicleType.last_row'),
            'right_row' => trans('vehicleType.right_row'),
            'right_column' => trans('vehicleType.right_column'),
            'left_row' => trans('vehicleType.left_row'),
            'left_column' => trans('vehicleType.left_column'),
            'total_no_of_seat' => trans('vehicleType.total_no_of_seat'),
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
            'driver_side.required' => ':attribute is required when Is Seat Details Required is checked.',
            'last_row.required' => ':attribute is required when Is Seat Details Required is checked.',
            'right_row.required' => ':attribute is required when Is Seat Details Required is checked.',
            'right_column.required' => ':attribute is required when Is Seat Details Required is checked.',
            'left_row.required' => ':attribute is required when Is Seat Details Required is checked.',
            'left_column.required' => ':attribute is required when Is Seat Details Required is checked.',
        ];
    }
}
