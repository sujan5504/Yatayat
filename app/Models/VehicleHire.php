<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class VehicleHire extends Model
{
    use CrudTrait;

    protected $table = 'vehicle_hires';
    protected $guarded = ['id'];
    protected $fillable = ['user_id','client_id','vehicle_id','name','contact','date_of_travel','from_id','to_id','remarks'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }

    public function destination_from(){
        return $this->belongsTo(Destination::class,'from_id','id');
    }

    public function destination_to(){
        return $this->belongsTo(Destination::class,'to_id','id');
    }
}
