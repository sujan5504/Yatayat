<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\Destination;
use App\Models\VehicleType;
use App\Models\BoardingPoint;
use App\Models\VehicleDetails;
use App\Base\BaseCrudController;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\VehicleDetailsRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleDetailsCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\VehicleDetails::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicledetail');
        CRUD::setEntityNameStrings(trans('vehicleDetail.title_text'), trans('vehicleDetail.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            [
                'name' => 'vehicle_id',
                'type' => 'select',
                'label' => trans('vehicleDetail.vehicle'),
                'entity' => 'vehicle',
                'model' => Vehicle::class,
                'attribute' => 'name',
            ],
            [
                'name' => 'vehicle_type_id',
                'type' => 'select',
                'label' => trans('vehicleDetail.vehicle_type'), 
                'entity' => 'vehicle_type',
                'model' => VehicleType::class,
                'attribute' => 'name',
            ],
            [
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
                'name'  => 'boarding_point',
                'label' => trans('vehicleDetail.boarding_point'),
                'type'  => 'table',
                'columns' => [
                    'point' => trans('vehicleDetail.point'),
                    'point_price' => trans('vehicleDetail.price'),
                ]
            ],
            [
                'name'  => 'amenities',
                'label' => trans('vehicleDetail.amenities'),
                'type'  => 'table',
                'columns' => [
                    'name' => trans('vehicleDetail.amenities'),
                ]
            ],
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VehicleDetailsRequest::class);

        $arr = [
            $this->addClientIdField(),
            [
                'name' => 'vehicle_id',
                'type' => 'select2',
                'label' => trans('vehicleDetail.vehicle'),
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
                'label' => trans('vehicleDetail.vehicle_type'), 
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
                'name' => 'vehicle_number',
                'type' => 'text',
                'label' => trans('vehicleDetail.vehicle_number'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
                'attributes' => [
                    'id' => 'vehicle_number',
                ]
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
                        'label' => trans('vehicleDetail.point'),
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
            [
                'name'            => 'amenities',
                'label'           => trans('vehicleDetail.amenities'),
                'type'            => 'repeatable',
                'fields'         => [
                    [
                        'name' => 'name',
                        'type' => 'text',
                        'label' => trans('vehicleDetail.amenities'),
                        'wrapper' => ['class' => 'form-group col-md-12'],
                    ],
                ],
                'new_item_label'  => 'Add Amenities',
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
