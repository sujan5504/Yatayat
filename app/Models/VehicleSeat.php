<?php

namespace App\Models;

use App\Models\Client;
use App\Models\VehicleDetails;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class VehicleSeat extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'vehicle_seats';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['client_id','vehicle_detail_id','date','vehicle_id','vehicle_type_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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
