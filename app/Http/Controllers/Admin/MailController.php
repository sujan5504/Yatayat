<?php

namespace App\Http\Controllers\Admin;

use PDF;
// use Mail;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request){
        $vehicle_assign_data = DB::select('SELECT d.name AS from_name,de.name AS to_name, c.name AS client_name, c.contact AS client_contact, 
                                            c.address as client_address,va.departure_time, vd.vehicle_number,va.price
                                            FROM vehicles_assign as va 
                                            LEFT JOIN destinations AS d ON d.id = va.from_id
                                            LEFT JOIN destinations AS de ON de.id = va.to_id
                                            LEFT JOIN clients as c ON c.id = va.client_id
                                            LEFT JOIN vehicle_details as vd on vd.id = va.vehicle_detail_id
                                            WHERE va.id ='.$request->data['vehicles_assign_id'].'');
        $seat_numbers = Seat::select('seat')->where('booking_id',$request->data['booking_id'])->get();
        $seat = '';
        foreach($seat_numbers as $seat_number){
            // dd($seat_number->seat);
            $seat .= ' ' . $seat_number->seat;
        }

        $data['email'] = $request->data['email'];
        // $data['email'] = 'shreeshashre@gmail.com';
        $data['title'] = 'Ticket';
        $data['body'] = 'we have attached a copy of your ticket with this email.';
        
        $data['name'] = $request->data['name'];
        $data['ticket_number'] = $request->data['ticket_number'];
        $data['boarding_point'] = $request->data['boarding_point'];
        $data['dropping_point'] = $request->data['dropping_point'];
        $data['cost'] = $request->data['cost'];
        $data['date'] = $request->data['date'];
        $data['time'] = $request->data['time'];
        $data['from'] = $vehicle_assign_data[0]->from_name;
        $data['to'] = $vehicle_assign_data[0]->to_name;
        $data['client_name'] = $vehicle_assign_data[0]->client_name;
        $data['client_contact'] = $vehicle_assign_data[0]->client_contact;
        $data['client_address'] = $vehicle_assign_data[0]->client_address;
        $data['departure_time'] = $vehicle_assign_data[0]->departure_time;
        $data['vehicle_number'] = $vehicle_assign_data[0]->vehicle_number;
        $data['seat'] = $seat;
        $data['price'] = $vehicle_assign_data[0]->price;

        $pdf = PDF::loadView('ticket', $data);

        try{
            Mail::send('ticket_body', $data, function($message)use($data, $pdf) {
                $message->to($data['email'], $data['name'])
                        ->subject($data['title'])
                        ->attachData($pdf->output(), 'Ticket.pdf');
            });

            $booking_id = $request->data['booking_id'];

            return $booking_id;
        }catch(\Exception $e){
            dd($e);
        }
    }
}
