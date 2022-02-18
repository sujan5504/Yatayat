<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookingPolicyRequest extends FormRequest
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
            'booking_policy' => function($attribute,$value,$fail){
                $fieldGroups = $value?json_decode($value):[];
 
                if (count($fieldGroups) == 0) {
                    return $fail('Booking Policy details is required.');
                }
 
                $attribute = [
                    'policy' => trans('bookingPolicy.policy'),
                    'deduction' => trans('bookingPolicy.deduction'),
                ];
 
                $message = [
                    'required' => ':attribute is a required field.',
                ];  
 
                foreach($fieldGroups as $key => $group){
                    $fieldGroupValidator = Validator::make((array)$group,[
                        'policy' => 'required',
                        'deduction' => 'required',
                    ],$message,$attribute);
 
                    if ($fieldGroupValidator->fails()) {
                        // return $fail('One of the entries in the '.$attribute.' group is invalid.');
                        // alternatively, you could just output the first error
                        return $fail($fieldGroupValidator->errors()->all());
                        // or you could use this to debug the errors
                            // dd($fieldGroupValidator->errors());
                    }
                }
            }
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
        ];
    }
}
