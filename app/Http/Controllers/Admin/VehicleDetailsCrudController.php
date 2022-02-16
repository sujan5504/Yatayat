<?php

namespace App\Http\Controllers\Admin;

use App\Models\VehicleDetails;
use App\Base\BaseCrudController;
use App\Http\Requests\VehicleDetailsRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleDetailsCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\VehicleDetails::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicledetail');
        CRUD::setEntityNameStrings('vehicle details', 'vehicle details');
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VehicleDetailsRequest::class);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
