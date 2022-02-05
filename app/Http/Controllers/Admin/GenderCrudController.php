<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use App\Base\BaseCrudController;
use App\Http\Requests\GenderRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class GenderCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(Gender::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gender');
        CRUD::setEntityNameStrings(trans('gender.title_text'), trans('gender.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addCodeColumn(),
            $this->addNameColumn(),
            $this->addIsActiveColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->crud->orderBy('id');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(GenderRequest::class);

        $arr = [
            $this->addCodeField(),
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
