<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Base\BaseCrudController;
use App\Http\Requests\VehicleRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(Vehicle::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicle');
        CRUD::setEntityNameStrings(trans('vehicle.title_text'), trans('vehicle.title_text'));
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
