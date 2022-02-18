<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use App\Base\BaseCrudController;
use App\Http\Requests\DestinationRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class DestinationCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(Destination::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/destination');
        CRUD::setEntityNameStrings(trans('destination.title_text'), trans('destination.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            $this->addNameColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->filterDataClientWise();
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(DestinationRequest::class);

        $arr = [
            $this->addClientIdField(),
            $this->addNameField(),
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
