<?php namespace App\Http\Controllers\Admin;

use App\Libs\Platform\Storage\Course\CourseRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Libs\Platform\Page\PageManager;
use Illuminate\Support\Facades\Request;

class CourseController extends Controller {
	private $course;
	protected $page = null;	// PageManager object
	protected $viewBase = '';	// base directory path of the view file
	/**
	 * Constructor method - inject the Course Repository
	 *
	 * @param App\Libs\Platform\Storage\Course\CourseRepository $course
	 */
	public function __construct(CourseRepository $course) {
		$this->page = new PageManager();
		$this->course = $course;
		$this->page->setActivePage('course');
		$this->page->setActiveSection(['catalog', 'course']);
		$this->viewBase = str_replace('\\', '.', str_replace('app\\http\\controllers\\', '', strtolower(get_called_class())));
		$this->viewBase = str_replace('controller', '', $this->viewBase);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return response
	 */
	public function index() {
		
		/* Default Variables */
        $active = 0;	// fetch only active entries or all entries
        $fields = ['id', 'course_name', 'course_code', 'description', 'is_active'];	// list of fields to be fetched
        /* Default Variables */
		
		if (Input::has('active')) {
            $active = 1;
        }
        if (Input::has('fields')) {	// separator is comma
            $fields = explode(',', Input::get('fields'));
		}
		
		/* Get Course */
		$response = $this->course->listing($active,$fields);
		/* Get Course */
		
		if(Request::segment(1) == 'api'){
			return response()->json($response->toArray());
		}
		
		/* Set Data To View */
		$this->page->getBody()->addToData('courses', $response);
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
		$data = Input::only('course_name', 'course_code', 'description', 'is_active');
		/* Separation & Limitations of Data By Models */
		
		/* Validate Input */
		$messages = $this->course->messages();
		$rules = $this->course->rules();

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

        /* Query Creation & Fire */
		$mr = $this->course->create($data);
		/* Query Creation & Fire */
		
		/* Redirect Based on Model Response */
		return redirect('course/' . $mr->id)->with(['success' => Lang::get('messages.crud.create.success', ['action' => 'created'])]);
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

		/* Get Course */
		$response = $this->course->view($id, $active, $fields, $with);
		/* Get Course */

		/* Set Data for View */
		$this->page->getBody()->addToData('course', $response);
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
		/* Default Variables */

		/* Get Course */
		$response = $this->course->view($id, $active, $fields, $with);
		/* Get Course */

		/* Set Data To View */
		$this->page->getBody()->addToData('course', $response);
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
		$data = Input::only('course_name', 'course_code', 'description', 'is_active');
		/* Separation & Limitations of Data By Models */
		
		/* Validate Input */
		$messages = $this->course->messages();
		$rules = $this->course->rules('update', $id);

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

		/* Query Creation & Fire */
		$mr = $this->course->update($id, $data);
		/* Query Creation & Fire */

		/* Redirect Based on Model Response */
		return redirect('course/' . $mr->id)->with(['success' => Lang::get('messages.crud.update.success', ['action' => 'updated'])]);
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
		$this->course->delete($id);
		/* Query Creation & Fire */

		/* Redirect Based on Model Response */
		return redirect('course')->with(['success' => Lang::get('messages.crud.delete.success', ['action' => 'deleted'])]);
		/* Redirect Based on Model Response */
	}    
}
