<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Base\BaseCrudController;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\VehicleTypeRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VehicleTypeCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(VehicleType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vehicletype');
        CRUD::setEntityNameStrings(trans('vehicleType.title_text'), trans('vehicleType.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            $this->addNameColumn(),
            [
                'name' => 'vehicle_id',
                'type' => 'select',
                'label' => trans('vehicleType.vehicle'),
                'entity' => 'vehicle',
                'attribute' => 'name',
                'model' => Vehicle::class,
            ],
            [
                'name' => 'total_no_of_seat',
                'type' => 'number',
                'label' => trans('vehicleType.total_no_of_seat'),
            ],
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
            [
                'name' => 'vehicle_id',
                'type' => 'select2',
                'label' => trans('vehicleType.vehicle'),
                'entity' => 'vehicle',
                'attribute' => 'name',
                'model' => Vehicle::class,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ],
                'attributes' => [
                    'id' => 'vehicle_type_change',
                ]
            ],
            $this->addNameField(),
            [
                'name' => 'total_no_of_seat',
                'type' => 'number',
                'label' => trans('vehicleType.total_no_of_seat'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-2',
                ],
                'attributes' => [
                    'id' => 'total_no_of_seat',
                ]
            ],
            $this->addIsActiveField(),
            [
                'name' => 'bus_seat_details',
                'type' => 'vehicle_type',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-12'
                ],
            ],
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(VehicleTypeRequest::class);

        $arr = [
            $this->addClientIdField(),
            [
                'name' => 'vehicle_id',
                'type' => 'select2',
                'label' => trans('vehicleType.vehicle'),
                'entity' => 'vehicle',
                'attribute' => 'name',
                'model' => Vehicle::class,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ],
                'attributes' => [
                    'id' => 'vehicle_type_change',
                ]
            ],
            $this->addNameField(),
            [
                'name' => 'total_no_of_seat',
                'type' => 'number',
                'label' => trans('vehicleType.total_no_of_seat'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-2',
                ],
                'attributes' => [
                    'id' => 'total_no_of_seat',
                ]
            ],
            $this->addIsActiveField(),
            [
                'name' => 'bus_seat_details',
                'type' => 'vehicle_type_edit',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-12'
                ],
            ],
        ];
        $this->crud->addFields($arr);
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        DB::beginTransaction();
        try{
            $data = [
                'client_id' => $request->client_id,
                'vehicle_id' => $request->vehicle_id,
                'name' => $request->name,
                'is_active' => $request->is_active,
                'remarks' => $request->remarks,
                'driver_side' => $request->driver_side,
                'last_row' => $request->last_row,
                'right_row' => $request->right_row,
                'right_column' => $request->right_column,
                'left_row' => $request->left_row,
                'left_column' => $request->left_column,
                'total_no_of_seat' => $request->total_no_of_seat,
            ];
            $item = VehicleType::create($data);
            DB::commit();
        }catch(\Throwable $th){
            DB::rollback();
        }

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
}
