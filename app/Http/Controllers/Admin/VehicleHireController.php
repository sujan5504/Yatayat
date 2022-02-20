<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Destination;
use App\Models\VehicleHire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VehicleHireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = backpack_user();
        if(isset($user)){
            $user_detail = $user;
        }
        $clients = Client::where('id','!=',1)->get();
        $destinations = Destination::all();

        return view('vehiclehire', compact('destinations','user_detail','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{   
            VehicleHire::create([
                'user_id' => $request->user_id,
                'client_id' => $request->client_id,
                'vehicle_id' => $request->vehicle_id,
                'name' => $request->name,
                'contact' => $request->contact,
                'date_of_travel' => $request->date_of_travel,
                'from_id' => $request->from_id,
                'to_id' => $request->to_id,
                'remarks' => $request->remarks,
            ]);
            DB::commit();
        }catch(\Throwable $th){
            DB::rollback();
        }
        return redirect()->route('vehiclehire.create');
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
        //
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
        //
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
