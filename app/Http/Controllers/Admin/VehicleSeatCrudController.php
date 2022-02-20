<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleSeat;
use App\Models\VehicleType;
use App\Models\VehicleDetails;
use App\Base\BaseCrudController;
use App\Http\Requests\VehicleSeatRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleSeatCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(VehicleSeat::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicleseat');
        CRUD::setEntityNameStrings('Vehicle Seat', 'Vehicle Seat');
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            [
                'name' => 'vehicle_id',
                'type' => 'select',
                'label' => 'Vehicle',
                'entity' => 'vehicle',
                'model' => Vehicle::class,
                'attribute' => 'name',
            ],
            [
                'name' => 'vehicle_type_id',
                'type' => 'select',
                'label' => 'Vehicle Type',
                'entity' => 'vehicle_type',
                'model' => VehicleType::class,
                'attribute' => 'name',
            ],
            [
                'name' => 'vehicle_detail_id',
                'type' => 'select',
                'label' => 'Vehicle Detail',
                'entity' => 'vehicle_detail',
                'model' => VehicleDetails::class,
                'attribute' => 'vehicle_number',
            ],
            [
                'name' => 'date',
                'label' => 'Date',
            ]
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VehicleSeatRequest::class);

        $arr = [
            $this->addClientIdField(),
            [
                'name' => 'vehicle_id',
                'type' => 'select2',
                'label' => 'Vehicle',
                'entity' => 'vehicle',
                'model' => Vehicle::class,
                'attribute' => 'name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'vehicle_type_id',
                'type' => 'select2_from_ajax',
                'label' => 'Vehicle Type', 
                'entity' => 'vehicle_type',
                'model' => VehicleType::class,
                'attribute' => 'name',
                'data_source' => url("api/vehicletype/vehicle_id"),
                'placeholder' => 'Select Vehicle First',
                'minimum_input_length' => 0,
                'method' => 'POST',
                'include_all_form_fields' => true,
                'dependencies' => ['vehicle_id'],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'vehicle_detail_id',
                'type' => 'select2_from_ajax',
                'label' => 'Vehicle Detail', 
                'entity' => 'vehicle_detail',
                'model' => VehicleDetails::class,
                'attribute' => 'vehicle_number',
                'data_source' => url("api/vehicledetail/vehicle_type_id"),
                'placeholder' => 'Select Vehicle Type First',
                'minimum_input_length' => 0,
                'method' => 'POST',
                'include_all_form_fields' => true,
                'dependencies' => ['vehicle_id'],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'date',
                'label' => 'Departure Date',
                'type' => 'nepali_date',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
                'attributes' => [
                    'id' => 'departure_date'
                ],
            ],
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
