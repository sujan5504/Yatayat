<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Seat;
use App\Models\User;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userdata = User::whereId($id)->get()->first();
        $genders = Gender::all();
        $user_gender = Gender::where('id', $userdata->gender_id)->pluck('name')->first(); 

        $booking_details = DB::select('SELECT b.id,c.name client_name, b.status, b.ticket_number, b.boarding_point, b.dropping_point, 
                            vt.name as vehicle_name, d.name as from_name, de.name as to_name, b.date, b.cost as price, b.created_at
                            FROM bookings AS b
                            LEFT JOIN clients AS c ON c.id = b.client_id
                            LEFT JOIN vehicles_assign AS va ON va.id = b.vehicles_assign_id
                            LEFT JOIN vehicle_types AS vt ON vt.id = va.vehicle_detail_id 
                            LEFT JOIN destinations AS d ON d.id = va.from_id
                            LEFT JOIN destinations AS de ON de.id = va.to_id
                            WHERE b.user_id ='."'".$id."'".'ORDER BY b.date DESC'
                        );
                        
        foreach($booking_details as $data){
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $data->created_at);
            $from = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
            $difference = $to->diffInHours($from);

            if($difference > 3){
                $data->booked_difference = 1;
            }else{
                $data->booked_difference = 0;
            }

            $seat = Seat::where('booking_id', $data->id)->pluck('seat');
            $seat = $seat->implode(" ");
            $data->seat = $seat;
        }

        return view('userprofile', compact('userdata','genders','user_gender', 'booking_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{   
            User::whereId($id)->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'age' => $request->age,
                'district' => $request->district,
                'city' => $request->city,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'gender_id' => $request->gender_id,
            ]);
            DB::commit();
        }catch(\Throwable $th){
            dd($th);
            DB::rollback();
        }
        return redirect()->route('userprofile.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
