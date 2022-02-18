<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'employees';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['full_name','employee_type_id','license_number','issued_date_bs','issued_date_ad',
                            'license_photo','employee_photo','contact','gender_id','email','is_active'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function setEmployeePhotoAttribute($value)
    {
        
        $attribute_name = "employee_photo";
        $disk = "uploads";
        $path  = 'EmployeePhoto/###id###/###name###/';

        $destination_path = str_replace("###id###", request()->id, $path);
        $destination_path = str_replace("###name###", request()->name, $destination_path);

        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        if (str_starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // $filename = '.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            // 3. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            // $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $destination_path . $filename;
        }
    }

    public function setLicensePhotoAttribute($value)
    {
        $attribute_name = "license_photo";
        $disk = "uploads";
        $path  = 'LicensePhoto/###id###/###name###/';

        $destination_path = str_replace("###id###", request()->id, $path);
        $destination_path = str_replace("###name###", request()->name, $destination_path);
        
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        if (str_starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // $filename = '.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            // 3. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            // $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $destination_path . $filename;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function employee_type(){
        return $this->belongsTo(EmployeeType::class,'employee_type_id','id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id','id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
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
