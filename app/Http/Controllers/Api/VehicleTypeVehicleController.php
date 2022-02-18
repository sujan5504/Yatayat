<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleTypeVehicleController extends Controller
{
    public function index(Request $request,$value){
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = VehicleType::query();
        // if no vehicle has been selected, show no options in vehicle_type
        if (!data_get($form, $value)) {
            return [];
        }

        // if a vehicle has been selected, only show vehicle_type from that vehicle
        if (data_get($form, $value)) {
            $options = $options->where('vehicle_id', $form[$value]);
        }

        if ($search_term) {
            $results = $options->where('name_lc', 'LIKE', '%' . $search_term . '%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }
}
