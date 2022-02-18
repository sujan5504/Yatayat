<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Base\BaseCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\PermissionManager\app\Http\Requests\RoleStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\RoleUpdateCrudRequest as UpdateRequest;

class RoleCrudController extends BaseCrudController
{
    public function setup()
    {
        $this->role_model = $role_model = config('backpack.permissionmanager.models.role');
        $this->permission_model = $permission_model = config('backpack.permissionmanager.models.permission');

        CRUD::setModel(Role::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/role');
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.role'), trans('backpack::permissionmanager.roles'));


        // deny access according to configuration file
        if (config('backpack.permissionmanager.allow_role_create') == false) {
            $this->crud->denyAccess('create');
        }
        if (config('backpack.permissionmanager.allow_role_update') == false) {
            $this->crud->denyAccess('update');
        }
        if (config('backpack.permissionmanager.allow_role_delete') == false) {
            $this->crud->denyAccess('delete');
        }
    }

    public function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
        ];
        $this->crud->addColumns($cols);        
    }

    public function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        
        $arr = [
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ]
            ]
        ];
        $this->crud->addFields($arr);

        //otherwise, changes won't have effect
        \Cache::forget('spatie.permission.cache');
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /*
     * Get an array list of all available guard types
     * that have been defined in app/config/auth.php
     *
     * @return array
     **/
    private function getGuardTypes()
    {
        $guards = config('auth.guards');

        $returnable = [];
        foreach ($guards as $key => $details) {
            $returnable[$key] = $key;
        }

        return $returnable;
    }
}
