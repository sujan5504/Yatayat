<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use CrudTrait;

    protected $guard_name = 'backpack';
    public $incrementing = true;

    protected $fillable = ['name', 'guard_name','updated_at', 'created_at'];

}
