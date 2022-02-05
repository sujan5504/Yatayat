<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmployeeType;
use App\Base\BaseCrudController;
use App\Http\Requests\EmployeeTypeRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeTypeCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(EmployeeType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee-type');
        CRUD::setEntityNameStrings(trans('employeeType.title_text'), trans('employeeType.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addNameColumn(),
            $this->addIsActiveColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->crud->orderBy('id');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeTypeRequest::class);

        $arr = [
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
