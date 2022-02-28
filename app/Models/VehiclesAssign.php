<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\Destination;
use App\Models\VehicleType;
use App\Models\VehicleDetails;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class VehiclesAssign extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'vehicles_assign';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['client_id','vehicle_id','vehicle_type_id','vehicle_detail_id','departure_date','departure_time','from_id',
                        'to_id','price','boarding_point','dropping_point','driver_employee_id','conductor_employee_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function from_to(){
        $from = Destination::where('id',$this->from_id)->pluck('name')->first();
        $to = Destination::where('id',$this->to_id)->pluck('name')->first();
        return $from.'<br>'.$to;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function vehicle_detail(){
        return $this->belongsTo(VehicleDetails::class,'vehicle_detail_id','id');
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }

    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class,'vehicle_type_id','id');
    }

    public function driver(){
        return $this->belongsTo(Employee::class,'driver_employee_id','id');
    }

    public function conductor(){
        return $this->belongsTo(Employee::class,'conductor_employee_id','id');
    }

    public function from(){
        return $this->belongsTo(Destination::class,'from_id','id');
    }

    public function to(){
        return $this->belongsTo(Destination::class,'to_id','id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
