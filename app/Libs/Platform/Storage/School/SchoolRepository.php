<?php namespace App\Libs\Platform\Storage\School;

interface SchoolRepository {
	
	public function create($data);	// method to create a new entry

	public function delete($id);	// method to delete an existing entry

	public function find($id);	// method to find an entry by id

	public function listing();	// method to fetch all entries

	public function messages();	// method to get validation messages

	public function rules($action, $id);	// method to get validation rules

	public function update($id, $data);	// method to update an existing entry

	public function view($id, $active, $fields, $with);	// method to get entry by id along with other criterias
}
