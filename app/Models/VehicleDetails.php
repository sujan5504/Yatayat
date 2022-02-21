<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class VehicleDetails extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'vehicle_details';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['client_id','vehicle_id','vehicle_type_id','vehicle_number','driver_employee_id','conductor_employee_id',
                        'amenities','to_id','from_id','boarding_point','price'];
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
