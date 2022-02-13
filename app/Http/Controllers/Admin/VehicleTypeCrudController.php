<?php

namespace App\Http\Controllers\Admin;

use App\Models\VehicleType;
use App\Base\BaseCrudController;
use App\Http\Requests\VehicleTypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleTypeCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\VehicleType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicletype');
        CRUD::setEntityNameStrings('vehicle type', 'vehicle types');
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            $this->addNameColumn(),
            $this->addIsActiveColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VehicleTypeRequest::class);

        $arr = [
            $this->addClientIdField(),
            $this->addNameField(),
            $this->addIsActiveField(),
            $this->addRemarksField(),
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
