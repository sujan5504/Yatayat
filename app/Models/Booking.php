<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $guarded = ['id'];
    protected $fillable = ['user_id','client_id','vehicles_assign_id','seat','boarding_point','droppint_point','cost','date','time',
                        'status','ticket_number'];
}
