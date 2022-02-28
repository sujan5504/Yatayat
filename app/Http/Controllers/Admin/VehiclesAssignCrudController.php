<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\Destination;
use App\Models\VehiclesAssign;
use App\Models\VehicleType;
use App\Models\VehicleDetails;
use App\Base\BaseCrudController;
use App\Http\Requests\VehiclesAssignRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehiclesAssignCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(VehiclesAssign::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicleassign');
        CRUD::setEntityNameStrings('Vehicle Assign', 'Vehicle Assign');
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
            ],[
                'name' => 'vehicle_number',
                'label' => trans('vehicleDetail.vehicle_number'),
            ],
            [
                'name' => 'fromto',
                'label' => trans('vehicleDetail.from').'<br>'.trans('vehicleDetail.to'),
                'type' => 'model_function',
                'function_name' => 'from_to',
            ],
            [
                'name' => 'price',
                'label' => trans('vehicleDetail.price'),
            ],
            [
                'name' => 'departure_date',
                'label' => 'Departure Date',
            ],
            [
                'name' => 'departure_time',
                'label' => trans('vehicleDetail.departure_time'),
            ],
            [
                'name'  => 'boarding_point',
                'label' => trans('vehicleDetail.boarding_point'),
                'type'  => 'table',
                'columns' => [
                    'point' => trans('vehicleDetail.boarding_point'),
                    'point_price' => trans('vehicleDetail.price'),
                ]
            ],
            [
                'name'  => 'dropping_point',
                'label' => trans('vehicleDetail.dropping_point'),
                'type'  => 'table',
                'columns' => [
                    'point' => trans('vehicleDetail.dropping_point'),
                    'point_price' => trans('vehicleDetail.price'),
                ]
            ],
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VehiclesAssignRequest::class);

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
                'name' => 'from_id',
                'type' => 'select2',
                'label' => trans('vehicleDetail.from'),
                'entity' => 'from',
                'model' => Destination::class,
                'attribute' => 'name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'to_id',
                'type' => 'select2',
                'label' => trans('vehicleDetail.to'),
                'entity' => 'to',
                'model' => Destination::class,
                'attribute' => 'name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'price',
                'type' => 'number',
                'label' => trans('vehicleDetail.price'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'departure_date',
                'label' => 'Departure Date',
                'type' => 'nepali_date',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
                'attributes' => [
                    'id' => 'departure_date'
                ],
            ],
            [
                'name' => 'departure_time',
                'type' => 'time',
                'label' => trans('vehicleDetail.departure_time'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'driver_employee_id',
                'type' => 'select2',
                'label' => trans('vehicleDetail.driver'),
                'entity' => 'driver',
                'model' => Employee::class,
                'attribute' => 'full_name',
                'options'   => (function ($query) {
                    return $query->where('employee_type_id', 1)->get();
                }),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'conductor_employee_id',
                'type' => 'select2',
                'label' => trans('vehicleDetail.conductor'),
                'entity' => 'conductor',
                'model' => Employee::class,
                'attribute' => 'full_name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
                'options'   => (function ($query) {
                    return $query->where('employee_type_id', 2)->get();
                }),
            ],
            [
                'name' => 'legend',
                'type' => 'custom_html',
                'value' => '',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-8',
                ],
            ],
            [
                'name'            => 'boarding_point',
                'label'           => trans('vehicleDetail.boarding_point'),
                'type'            => 'repeatable',
                'fields'         => [
                    [
                        'name' => 'point',
                        'type' => 'text',
                        'label' => trans('vehicleDetail.boarding_point'),
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
                    [
                        'name' => 'time',
                        'type' => 'time',
                        'label' => trans('vehicleDetail.time'),
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
                ],
                'new_item_label'  => 'Add Boarding Point',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-12',
                ],
            ],
            [
                'name'            => 'dropping_point',
                'label'           => trans('vehicleDetail.dropping_point'),
                'type'            => 'repeatable',
                'fields'         => [
                    [
                        'name' => 'point',
                        'type' => 'text',
                        'label' => trans('vehicleDetail.dropping_point'),
                        'wrapper' => ['class' => 'form-group col-md-6'],
                    ],
                    [
                        'name' => 'point_price',
                        'type' => 'text',
                        'label' => trans('vehicleDetail.price'),
                        'wrapper' => ['class' => 'form-group col-md-6'],
                    ],
                ],
                'new_item_label'  => 'Add Boarding Point',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
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
