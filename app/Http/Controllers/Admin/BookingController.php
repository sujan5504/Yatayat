<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\VehiclesAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function store(Request $request){
        DB::beginTransaction();
        try{   
            Booking::create([
                'ticket_number' => $request->ticket_number,
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'vehicles_assign_id' => $request->vehicles_assign_id,
                'boarding_point' => $request->boarding_point,
                'dropping_point' => $request->dropping_point,
                'cost' => $request->cost,
                'date' => $request->date,
                'time' => $request->time,
                'status' => false,
            ]);
            // DB::commit();
        }catch(\Throwable $th){
            dd($th);
            DB::rollback();
        }
    }

    public function getSelectedSeatDetails(Request $request){
        $user = User::select('name','contact','email')->whereId($request->user_id)->get()->first();
        $vehicle_seat = VehiclesAssign::select('boarding_point','dropping_point','departure_date','departure_time','from_id','to_id','price')
                    ->whereId($request->vehicles_assign_id)->get()->first();
        $from = Destination::select('id','name')->whereId($vehicle_seat->from_id)->get()->first();
        $to = Destination::select('id','name')->whereId($vehicle_seat->to_id)->get()->first();
        $client = Client::select('name')->whereId($request->client_id)->get()->first();
        $data = [
            'user_id' => $request->user_id,
            'name' => $user->name,
            'contact' => $user->contact,
            'email' => $user->email,
            'client_id' => $request->client_id,
            'client_name' => $client,
            'vehicles_assign_id' => $request->vehicles_assign_id,
            'date' => $vehicle_seat->departure_date, 
            'time' => $vehicle_seat->departure_time, 
            'boarding_point' => $vehicle_seat->boarding_point,
            'dropping_point' => $vehicle_seat->dropping_point,
            'from' => $from->name,
            'to' => $to->name,
            'price' => $vehicle_seat->price,
            'seat_number' => $request->seat_number, 
            'total_price' => $request->total_price,
            'total_seat' => $request->total_seat,
        ];

        return view('seat_confirm', compact('data'));
    }
}
