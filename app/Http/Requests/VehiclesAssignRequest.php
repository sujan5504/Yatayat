<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VehiclesAssignRequest extends FormRequest
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
            'vehicle_id' => 'required',
            'vehicle_type_id' => 'required',
            'vehicle_detail_id' => 'required',
            'price' => 'required',
        ];
        if(request()->vehicle_id == 2){
            $rules['departure_date'] = 'required';
            $rules['departure_time'] = 'required';
            $rules['from_id'] = 'required';
            $rules['to_id'] = 'required';
            $rules['boarding_point'] = function($attribute,$value,$fail){
                $fieldGroups = $value?json_decode($value):[];
 
                if (count($fieldGroups) == 0) {
                    return $fail('Booking Point details is required.');
                }
 
                $attribute = [
                    'point' => trans('vehicleDetail.boarding_point'),
                    'time' => trans('vehicleDetail.time'),
                ];
 
                $message = [
                    'required' => ':attribute is a required field.',
                ];  
 
                foreach($fieldGroups as $key => $group){
                    $fieldGroupValidator = Validator::make((array)$group,[
                        'point' => 'required',
                        'time' => 'required',
                    ],$message,$attribute);
 
                    if ($fieldGroupValidator->fails()) {
                        // return $fail('One of the entries in the '.$attribute.' group is invalid.');
                        // alternatively, you could just output the first error
                        return $fail($fieldGroupValidator->errors()->all());
                        // or you could use this to debug the errors
                            // dd($fieldGroupValidator->errors());
                    }
                }
            };
            $rules['dropping_point'] = function($attribute,$value,$fail){
                $fieldGroups = $value?json_decode($value):[];
 
                if (count($fieldGroups) == 0) {
                    return $fail('Dropping Point details is required.');
                }
 
                $attribute = [
                    'point' => trans('vehicleDetail.dropping_point'),
                    'point_price' => trans('vehicleDetail.price'),
                ];
 
                $message = [
                    'required' => ':attribute is a required field.',
                ];  
 
                foreach($fieldGroups as $key => $group){
                    $fieldGroupValidator = Validator::make((array)$group,[
                        'point' => 'required',
                        'point_price' => 'required',
                    ],$message,$attribute);
 
                    if ($fieldGroupValidator->fails()) {
                        // return $fail('One of the entries in the '.$attribute.' group is invalid.');
                        // alternatively, you could just output the first error
                        return $fail($fieldGroupValidator->errors()->all());
                        // or you could use this to debug the errors
                            // dd($fieldGroupValidator->errors());
                    }
                }
            };
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
            'vehicle_id' => 'Vehicle',
            'vehicle_type_id' => 'Vehicle Type',
            'vehicle_detail_id' => 'Vehicle Detail',
            'price' => 'Price',
            'departure_date' => 'Departure Date',
            'departure_time' => 'Departure Time',
            'from_id' => 'From (Soruce)',
            'to_id' => 'To (Destination)',
            'boarding_point' => 'Boarding Point',
            'dropping_point' => 'Dropping Point',
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
