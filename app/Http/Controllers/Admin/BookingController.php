<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seat;
use App\Models\User;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\VehiclesAssign;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function store(Request $request){
        DB::beginTransaction();
        try{   
            $data = [
                'user_id' => $request->user_id,
                'name' => $request->name,
                'contact' => $request->contact,
                'email' => $request->email,
                'client_id' => $request->client_id,
                'ticket_number' => $request->ticket_number,
                'vehicles_assign_id' => $request->vehicles_assign_id,
                'boarding_point' => $request->boarding_point,
                'dropping_point' => $request->dropping_point,
                'cost' => $request->cost,
                'date' => $request->date,
                'time' => $request->time,
                'status' => false,
            ];
            $booking = Booking::create($data);

            $seats = explode(' ', $request->seat);
            foreach($seats as $seat){
                Seat::create([
                    'booking_id' => $booking->id,
                    'vehicles_assign_id' => $request->vehicles_assign_id,
                    'seat' => $seat,
                ]);
            }
            DB::commit();
            $data += ['booking_id' => $booking->id];
            return $data;
        }catch(\Throwable $th){
            dd($th);
            DB::rollback();
            return 0;
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

    public function bookingTicketDetails($id){
        $data = DB::select('
            SELECT
                b.id as booking_id,
                b.name,
                b.contact,
                b.email,
                b.ticket_number,
                b.boarding_point,
                b.dropping_point,
                b.cost,
                b.date,
                b.time,
                d.name	AS from_name,
                de.name AS to_name,
                c.NAME AS client_name,
                c.address AS client_address,
                c.contact AS client_contact, 
                vs.vehicle_number,
                va.departure_time,
                va.departure_date,
                va.price
            FROM
                bookings AS b
                LEFT JOIN vehicles_assign AS va ON va.id = b.vehicles_assign_id
                LEFT JOIN destinations AS d ON d.id = va.from_id
                LEFT JOIN destinations AS de ON de.id = va.to_id
                LEFT JOIN clients AS c ON c.id = b.client_id
                LEFT JOIN vehicle_details AS vs ON vs.id = va.vehicle_detail_id 
            WHERE
                b.id ='.$id.'');
        $seat_numbers = Seat::select('seat')->where('booking_id',$data[0]->booking_id)->get();
        $seat = '';
        foreach($seat_numbers as $seat_number){
            $seat .= ' ' . $seat_number->seat;
        }
        $status = 0;

        return view('booking_ticket', compact('data','seat','status'));
    }

    public function bookingCancel(Request $request){
        $data = [
            'status' => true,
        ];

        try{  
            Booking::where('id', '=', $request->id)->update($data);
            DB::commit();
            return 1;
        }catch(\Throwable $th){
            DB::rollback();
            return 0;
        }
    }

    public function searchTicketDetails(Request $request){
        $data = DB::select('SELECT b.id as booking_id,b.name,b.contact,b.email,b.boarding_point,b.dropping_point,b.cost,b.date,b.time,
                d.name AS from_name,de.name AS to_name,c.NAME AS client_name,c.address AS client_address,c.contact AS client_contact, 
                vs.vehicle_number,va.departure_time,va.departure_date,va.price,b.ticket_number
                FROM bookings AS b
                LEFT JOIN vehicles_assign AS va ON va.id = b.vehicles_assign_id
                LEFT JOIN destinations AS d ON d.id = va.from_id
                LEFT JOIN destinations AS de ON de.id = va.to_id
                LEFT JOIN clients AS c ON c.id = b.client_id
                LEFT JOIN vehicle_details AS vs ON vs.id = va.vehicle_detail_id 
                WHERE b.ticket_number ='."'".$request->ticket_number."'");
        if($data != []){
            $seat_numbers = Seat::select('seat')->where('booking_id',$data[0]->booking_id)->get();
            $seat = '';
            foreach($seat_numbers as $seat_number){
                $seat .= ' ' . $seat_number->seat;
            }
        }else{
            $seat = '';
        }
        $ticket_number = $request->ticket_number;
        $status = 1;
        return view('booking_ticket', compact('data','seat','status','ticket_number'));
    }
}
