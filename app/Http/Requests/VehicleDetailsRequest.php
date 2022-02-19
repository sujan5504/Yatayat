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
            'to_id' => 'required',
            'from_id' => 'required',
            // 'boarding_point' => function($attribute,$value,$fail){
            //     $fieldGroups = $value?json_decode($value):[];
 
            //     if (count($fieldGroups) == 0) {
            //         return $fail('Booking Point details is required.');
            //     }
 
            //     $attribute = [
            //         'point' => trans('vehicleDetail.point'),
            //         'price' => trans('vehicleDetail.price'),
            //     ];
 
            //     $message = [
            //         'required' => ':attribute is a required field.',
            //     ];  
 
            //     foreach($fieldGroups as $key => $group){
            //         $fieldGroupValidator = Validator::make((array)$group,[
            //             'point' => 'required',
            //             'price' => 'required',
            //         ],$message,$attribute);
 
            //         if ($fieldGroupValidator->fails()) {
            //             // return $fail('One of the entries in the '.$attribute.' group is invalid.');
            //             // alternatively, you could just output the first error
            //             return $fail($fieldGroupValidator->errors()->all());
            //             // or you could use this to debug the errors
            //                 // dd($fieldGroupValidator->errors());
            //         }
            //     }
            // },
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
            'to_id' => trans('vehicleDetail.to'),
            'from_id' => trans('vehicleDetail.from'),
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
            //
        ];
    }
}
