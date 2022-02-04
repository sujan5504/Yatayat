<?php

namespace App\Base;

use App\Base\Operations\ListOperation;
use App\Base\Operations\ShowOperation;
use App\Base\Operations\CreateOperation;
use App\Base\Operations\DeleteOperation;
use App\Base\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BaseCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function __construct()
    {
        parent::__construct();
    }

    protected function addRowNumber(){
        return [
            'name' => 'row_number',
            'type' => 'row_number',
            'label' => trans('common.sn'),
        ];
    }

    protected function addCodeColumn(){
        return[
            'name' => 'code',
            'label' => trans('common.code'),
        ];
    }

    protected function addCodeField(){
        return[
            'name' => 'code',
            'type' => 'text',
            'label' => trans('common.code'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-2',
            ],
        ];
    }

    protected function addNameColumn(){
        return[
            'name' => 'name',
            'label' => trans('common.name'),
        ];
    }

    protected function addNameField(){
        return[
            'name' => 'name',
            'type' => 'text',
            'label' => trans('common.name'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ];
    }

    protected function addIsActiveColumn(){
        return[
            'name' => 'is_active', 
            'label' => trans('common.is_active'), 
            'type' => 'radio',
            'options' => [
                0 => "NO",
                1 => "Yes"
            ],
        ];
    }

    protected function addIsActiveField(){
        return[
            'name' => 'is_active', 
            'label' => trans('common.is_active'), 
            'type' => 'radio',
            'options' => [
                0 => "NO",
                1 => "Yes"
            ],
            'inline'      => true, 
            'default' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ];
    }

    protected function addRemarksField(){
        return[
            'name' => 'remarks',
            'type' => 'textarea',
            'label' => trans('common.remarks'), 
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],  
        ];
    }
}
