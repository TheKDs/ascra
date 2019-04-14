<?php

namespace App\Libs\Platform\Storage\Course;

use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class EloquentCourseRepository implements CourseRepository {

    protected $model;

    public function __construct(Course $model) {
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
    
    public function listing($active=true, $fields=[]) {
        $query = $this->model->newQuery(); 
        if ($active) {
            $query->where('is_active', '=', 1);
        }
        if (!$fields) {
            $fields = ['*'];
        }
        return $query->get($fields);
    }

    public function messages() {
        return [
            'course_name.required' => 'Course name is required',
            'course_code.required' => 'Course code is required',
            'description.required' => 'Course description is required',
            'is_active.required' => 'Active status is required',
        ];
    }

    public function rules($action = '', $id = null) {
        $rules = [
            'course_name' => 'required',
            'course_code' => 'required',
            'description' => 'required',
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
