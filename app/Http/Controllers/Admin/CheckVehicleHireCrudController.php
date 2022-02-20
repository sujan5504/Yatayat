<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Destination;
use App\Models\VehicleHire;
use App\Base\BaseCrudController;
use App\Http\Requests\CheckVehicleHireRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CheckVehicleHireCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(VehicleHire::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/checkvehiclehire');
        CRUD::setEntityNameStrings('Vehicle Hire Requests', 'Vehicle Hire Requests');
    }

    protected function setupListOperation()
    {
        $this->crud->removeButtons(['create','update','delete','show']);

        $cols = [
            $this->addRowNumber(),
            [
                'name' => 'name',
                'label' => 'Name',
            ],
            [
                'name' => 'vehicle_id',
                'type' => 'select',
                'label' => 'Vehicle',
                'entity' => 'vehicle',
                'attribute' => 'name',
                'model' => Vehicle::class, 
            ],
            [
                'name' => 'contact',
                'label' => 'Contact',
            ],
            [
                'name' => 'date_of_travel',
                'label' => 'Date of Travel',
            ],
            [
                'name' => 'from_id',
                'type' => 'select',
                'label' => 'Journey From',
                'entity' => 'destination_from',
                'attribute' => 'name',
                'model' => Destination::class, 
            ],
            [
                'name' => 'to_id',
                'type' => 'select',
                'label' => 'Journey To',
                'entity' => 'destination_to',
                'attribute' => 'name',
                'model' => Destination::class, 
            ],
        ];
        $this->crud->addColumns($cols);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        // CRUD::setValidation(CheckVehicleHireRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
