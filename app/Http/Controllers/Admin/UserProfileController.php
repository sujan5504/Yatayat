<?php

namespace App\Http\Controllers\Admin;

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

        return view('userprofile', compact('userdata','genders','user_gender'));
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
