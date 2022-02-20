<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DependentDropdownController extends Controller
{
    public function getVehicle($id)
    {   
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            abort(404);
        }else {
            $vehicle = Vehicle::where('client_id', $id)->orWhere('client_id','1')->get();
            return response()->json($vehicle);
        }
    }
}
