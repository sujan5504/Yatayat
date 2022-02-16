<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookingPolicy;
use App\Base\BaseCrudController;
use App\Http\Requests\BookingPolicyRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BookingPolicyCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\BookingPolicy::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bookingpolicy');
        CRUD::setEntityNameStrings('booking policy', 'booking policies');
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addClientIdColumn(),
            [
                'name'  => 'booking_policy',
                'label' => trans('bookingPolicy.booking_policy'),
                'type'  => 'table',
                'columns' => [
                    'policy'        => trans('bookingPolicy.policy'),
                    'deduction' => trans('bookingPolicy.deduction'),
                ]
            ],
        ];
        $this->crud->addColumns($cols);
        $this->hideClientIdColumn();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookingPolicyRequest::class);

        $arr = [
            $this->addClientIdField(),
            [
                'name'            => 'booking_policy',
                'label'           => trans('bookingPolicy.booking_policy'),
                'type'            => 'repeatable',
                'fields'         => [
                    [
                        'name' => 'policy',
                        'type' => 'text',
                        'label' => trans('bookingPolicy.policy'),
                        'wrapper' => ['class' => 'form-group col-md-8'],
                    ],
                    [
                        'name' => 'deduction',
                        'type' => 'text',
                        'label' => trans('bookingPolicy.deduction'),
                        'wrapper' => ['class' => 'form-group col-md-4'],
                    ],
                ],
                'new_item_label'  => 'Add Policy',
            ],
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
