<?php

namespace App\Base;

use App\Models\Client;
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

    protected function addClientIdColumn(){
        return[
            'name' => 'client_id',
            'type' => 'select',
            'label' => trans('common.client'),
            'entity' => 'client',
            'attribute' => 'name',
            'model' => Client::class,
        ];
    }

    protected function hideClientIdColumn(){
        if(backpack_user()->hasRole('clientadmin') || backpack_user()->hasRole('operator') || backpack_user()->hasRole('user')){
            $this->crud->removeColumn('client_id');
        }
    }
    
    protected function addClientIdField(){
        if(backpack_user()->hasRole('superadmin')){
            return[
                'name' => 'client_id',
                'type' => 'select2',
                'label' => trans('common.client'),
                'entity' => 'client',
                'attribute' => 'name',
                'model' => Client::class,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ],
                'attributes'=>[
                    'required' => 'Required',
                ],
            ];
        }else{
            return[
                'name' => 'client_id',
                'type' => 'hidden',
                'value' => backpack_user()->client_id,
            ];
        }
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

    protected function filterDataClientWise(){
        $this->crud->addClause('where', 'client_id', '1');
        $this->crud->addClause('orWhere', 'client_id', backpack_user()->client_id);
    }
}
