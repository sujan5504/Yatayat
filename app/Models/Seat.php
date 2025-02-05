<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats';
    protected $guarder = ['id'];
    protected $fillable = ['booking_id','vehicles_assign_id','seat'];
}
