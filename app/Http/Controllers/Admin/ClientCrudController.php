<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Base\BaseCrudController;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClientRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ClientCrudController extends BaseCrudController
{
    public function setup()
    {
        CRUD::setModel(\App\Models\Client::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/client');
        CRUD::setEntityNameStrings(trans('client.title_text'), trans('client.title_text'));
    }

    protected function setupListOperation()
    {
        $cols = [
            $this->addRowNumber(),
            $this->addNameColumn(),
            [
                'name' => 'email',
                'label' => trans('client.email'),
            ],
            [
                'name' => 'contact',
                'label' => trans('client.contact'),
            ],
            $this->addIsActiveColumn(),
        ];
        $this->crud->addColumns($cols);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClientRequest::class);

        $arr = [
            $this->addNameField(),
            [
                'name' => 'email',
                'type' => 'email',
                'label' => trans('client.email'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name' => 'contact',
                'type' => 'text',
                'label' => trans('client.contact'),
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
            $this->addIsActiveField(),
        ];
        $this->crud->addFields($arr);
        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // insert item in the db
        $item = $this->crud->create($this->crud->getStrippedSaveRequest());
        $this->data['entry'] = $this->crud->entry = $item;
        try{
            DB::beginTransaction();
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('Client@1234'),
                'client_id' => $item->id,
            ]);
            $user->assignRoleCustom("clientadmin",$user->id);

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
