<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CrudTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'password',
        'contact',
        'age',
        'district',
        'city',
        'email',
        'gender_id',
        'client_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function assignRoleCustom($role_name, $model_id){
        $roleModel = Role::where('name', $role_name)
        ->take(1)
        ->get();

        if(count($roleModel) == 0){
            return "role doesnot exists";
        }

        DB::table('model_has_roles')->insert([
            'role_id' => $roleModel[0]->id,
            'model_type' => 'App\Models\BackpackUser',
            'model_id' => $model_id,
        ]);
    }
}
