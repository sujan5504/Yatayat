<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class VehicleHire extends Model
{
    use CrudTrait;

    protected $table = 'vehicle_hires';
    protected $guarded = ['id'];
    protected $fillable = ['user_id','client_id','vehicle_id','name','contact','date_of_travel','from_id','to_id','remarks'];
}
