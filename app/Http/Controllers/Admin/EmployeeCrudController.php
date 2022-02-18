<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Base\BaseCrudController;
use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings(trans('employee.title_text'), trans('employee.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            [
                'name' => 'full_name',
                'label' => trans('employee.full_name'),
            ],
            [
                'name'=>'employee_type_id',
                'type'=>'select',
                'label'=>trans('employee.employee_type'),
                'entity'=>'employee_type',
                'model'=>EmployeeType::class,
                'attribute'=>'name',
            ],
            [
                'name' => 'contact',
                'type' => 'text',
                'label' => trans('employee.contact'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'email',
                'type' => 'text',
                'label' => trans('employee.email'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name' => 'license_number',
                'type' => 'text',
                'label' => trans('employee.license_number'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3 driver_license_info',
                ],
            ],
            $this->addIsActiveColumn(),
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);

        $arr = [
            $this->addClientIdField(),
            [
                'name' => 'full_name',
                'type' => 'text',
                'label' => trans('employee.full_name'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name'=>'gender_id',
                'type'=>'select2',
                'label'=>trans('employee.gender'),
                'entity'=>'gender',
                'model'=>Gender::class,
                'attribute'=>'name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name'=>'employee_type_id',
                'type'=>'select2',
                'label'=>trans('employee.employee_type'),
                'entity'=>'employee_type',
                'model'=>EmployeeType::class,
                'attribute'=>'name',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'contact',
                'type' => 'text',
                'label' => trans('employee.contact'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],
            ],
            [
                'name' => 'email',
                'type' => 'text',
                'label' => trans('employee.email'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name' => 'employee_photo',
                'type' => 'image',
                'label' => trans('employee.employee_photo'),
                'disk' => 'uploads',
                'upload' => true,
                'crop' => true,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3',
                ],

            ],
            $this->addIsActiveField(),
            [
                'name' => 'legend',
                'type' => 'custom_html',
                'value' => '<legend class="bg-secondary">License Details:</legend>',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-12 driver_license_info',
                ],
            ],
            [
                'name' => 'license_number',
                'type' => 'text',
                'label' => trans('employee.license_number'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3 driver_license_info',
                ],
            ],
            [
                'name' => 'issued_date_bs',
                'type' => 'nepali_date',
                'label' => trans('employee.issued_date_bs'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3 driver_license_info',
                ],
                'attributes' => [
                    'id' => 'issued_date_bs',
                    'related_id' => 'issued_date_ad',
                ]
            ],
            [
                'name' => 'issued_date_ad',
                'type' => 'date',
                'label' => trans('employee.issued_date_ad'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3 driver_license_info',
                ],
                'attributes' => [
                    'id' => 'issued_date_ad',
                ],
            ],
            [
                'name' => 'license_photo',
                'type' => 'image',
                'label' => trans('employee.license_photo'),
                'disk' => 'uploads',
                'upload' => true,
                'crop' => true,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6 driver_license_info',
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
