<?php namespace App\Http\Controllers\Admin;

use App\Libs\Platform\Storage\School\SchoolRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Libs\Platform\Page\PageManager;
use Illuminate\Support\Facades\Request;

class SchoolController extends Controller {
	private $school;
	protected $page = null;	// PageManager object
	protected $viewBase = '';	// base directory path of the view file
	/**
	 * Constructor method - inject the School Repository
	 *
	 * @param App\Libs\Platform\Storage\School\SchoolRepository $school
	 */
	public function __construct(SchoolRepository $school) {
		$this->page = new PageManager();
		$this->school = $school;
		$this->page->setActivePage('school');
		$this->page->setActiveSection(['catalog', 'school']);
		$this->viewBase = str_replace('\\', '.', str_replace('app\\http\\controllers\\', '', strtolower(get_called_class())));
		$this->viewBase = str_replace('controller', '', $this->viewBase);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return response
	 */
	public function index() {
		
		/* Get School */
		$response = $this->school->listing();
		/* Get School */
		
		/* Set Data To View */
		$this->page->getBody()->addToData('schools', $response);
		/* Set Data To View */

		/* HTML View Response */
		return response()->view($this->viewBase . '.' . __FUNCTION__, ['page' => $this->page]);
		/* HTML View Response */
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return response
	 */
	public function create() {
		
		/* HTML View Response */
		return response()->view($this->viewBase . '.' . __FUNCTION__, ['page' => $this->page]);
		/* HTML View Response */
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return redirect
	 */
	public function store() {
		/* Separation & Limitations of Data By Models */
		$data = Input::only('name', 'mobile', 'address', 'is_active');
		$courseIds = Input::only('course_id');
		/* Separation & Limitations of Data By Models */

		/* Validate Input */
		$messages = $this->school->messages();
		$rules = $this->school->rules();

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

        /* Query Creation & Fire */
		$mr = $this->school->create($data);
		if($mr){
			foreach($courseIds['course_id'] as $course){
				$mr->courses()->attach($course);
			}
		}
		/* Query Creation & Fire */

		/* Redirect Based on Model Response */
		return redirect('school/' . $mr->id)->with(['success' => Lang::get('messages.crud.create.success', ['action' => 'created'])]);
		/* Redirect Based on Model Response */
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return response
	 */
	public function show($id) {
		/* Default Variables */
		$active = false;
		$fields = [];
		$with = [];
		/* Default Variables */

		/* Get School */
		$response = $this->school->view($id, $active, $fields, $with);
		/* Get School */

		/* Set Data for View */
		$this->page->getBody()->addToData('school', $response);
		/* Set Data for View */

		/* HTML View Response */
		return response()->view($this->viewBase . '.' . __FUNCTION__, ['page' => $this->page]);
		/* HTML View Response */
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return response
	 */
	public function edit($id) {
		/* Default Variables */
		$active = false;
		$fields = [];
		$with = [];
		$course_id = [];
		/* Default Variables */

		/* Get School */
		$response = $this->school->view($id, $active, $fields, $with);
		/* Get School */
		if($response){
			foreach ($response->courses as $course) {
				$course_id[]=($course->pivot->course_id);
			}
		}
		$courseId = app('App\Libs\Platform\Storage\Course\CourseRepository')->find($course_id);
		
		/* Set Data To View */
		$this->page->getBody()->addToData('school', $response);
		$courseIds = ($courseId) ? $courseId->toArray() : null ;
		$this->page->getBody()->addToData('courseIds', $courseIds);		
		/* Set Data To View */

		/* HTML View Response */
		return response()->view($this->viewBase . '.' . __FUNCTION__, ['page' => $this->page]);
		/* HTML View Response */
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return redirect
	 */
	public function update($id) {
		/* Separation & Limitations of Data By Models */
		$data = Input::only('name', 'mobile', 'address', 'is_active');
		$courseIds = Input::only('course_id');
		/* Separation & Limitations of Data By Models */
		
		/* Validate Input */
		$messages = $this->school->messages();
		$rules = $this->school->rules('update', $id);

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

		/* Query Creation & Fire */
		$mr = $this->school->update($id, $data);
		if($mr){
			foreach($courseIds['course_id'] as $course_id){
				$syncData[]= $course_id;
				
			}
			$mr->courses()->sync($syncData);
		}
		/* Query Creation & Fire */

		/* Redirect Based on Model Response */
		return redirect('school/' . $mr->id)->with(['success' => Lang::get('messages.crud.update.success', ['action' => 'updated'])]);
		/* Redirect Based on Model Response */
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return response
	 */
	public function destroy($id) {
		/* Query Creation & Fire */
		$this->school->delete($id);
		/* Query Creation & Fire */

		/* Redirect Based on Model Response */
		return redirect('school')->with(['success' => Lang::get('messages.crud.delete.success', ['action' => 'deleted'])]);
		/* Redirect Based on Model Response */
	}    
}
