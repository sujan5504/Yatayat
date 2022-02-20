<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\VehicleDetails;
use App\Http\Controllers\Controller;

class VehicleTypeVehicleDetail extends Controller
{
    public function index(Request $request,$value){
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = VehicleDetails::query();

        if (!data_get($form, $value)) {
            return [];
        }

        if (data_get($form, $value)) {
            $options = $options->where('vehicle_type_id', $form[$value]);
        }
        if ($search_term) {
            $results = $options->where('vehicle_number', 'LIKE', '%' . $search_term . '%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }
}
