<?php

namespace App\Libs\Platform\Storage\School;

use App\Models\School;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class EloquentSchoolRepository implements SchoolRepository {

    protected $model;

    public function __construct(School $model) {
        $this->model = $model;
    }

    public function create($data) {
        
        return $this->model->create($data);
    }

    public function delete($id) {
        $resource = $this->find($id);
        return $resource->delete();
    }

    public function find($id) {
        return $this->model->find($id);
    }
    
    public function listing() {
        $result = $this->model->select(['is_active', 'name', 'address', 'mobile', 'id']);

        if (Input::has('name')) {
            $result->where('name', '=', Input::get('name'));
        }

        return $result->get();
    }

    public function messages() {
        return [
            'name.required' => 'School name is required',
            'address.required' => 'School address is required',
            'mobile.required' => 'School contact is required',
            'mobile.regex' => 'Invalid mobile number',
            'is_active.required' => 'Active status is required',
        ];
    }

    public function rules($action = '', $id = null) {
        $rules = [
            'name' => 'required',
            'mobile' => 'required|regex:/[-\(\)\+0-9\s]/',
            'address' => 'required',
            'is_active' => 'required|boolean',
        ];

        return $rules;
    }

    public function update($id, $data) {
        
        $resource = $this->model->find($id);

        if ($resource->update($data)) {
            return $resource;
        }
        return false;
    }

    public function view($id, $active = true, $fields = [], $with = []) {
        $query = $this->model->newQuery();

        if ($active) {
            $query->where('is_active', '=', 1);
        }
        if (!$fields) {
            $fields = ['*'];
        }
        if ($with) {
            $with = $this->model->processWithSelects($with);
            $query->with($with);
        }

        try {
            return $query->where('id', '=', $id)->first($fields);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

}
