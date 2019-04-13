<?php namespace App\Http\Controllers\Admin;

use App\Libs\Platform\Storage\School\SchoolRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Libs\Platform\Page\PageManager;

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
		/* Default Variables */
		$active = 0;	// fetch only active entries or all entries
		$fields = [];	// list of fields to be fetched
		$filters = [];	// list of filters (where clause)
		$limit = 25;	// number of entries
		$metaDesc = 'List of schools';	// meta description
		$metaKeywords = 'list, schools, list of schools, school list';	// meta keywords
		$sort = ['name'];	// sorting of data
		$title = 'School List';
		$with = [];
		/* Default Variables */
		
		/* Breadcrumbs */
		$this->page->getBody()->addBreadcrumb('School', 'school');
		$this->page->getBody()->addBreadcrumb('Listing');
		/* Breadcrumbs */

		/* Page Maker */
		$this->page->getHead()->setDescription($metaDesc);
		$this->page->getHead()->setKeywords($metaKeywords);
		$this->page->setTitle($title);
		/* Page Maker */

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
		/* Default Variables */
		$metaDesc = 'Create a new school';	// meta description
		$metaKeywords = 'create, new, school, new school, create school, create new school';	// meta keywords
		$title = 'Create School';
		/* Default Variables */

		/* Breadcrumbs */
		$this->page->getBody()->addBreadcrumb('School', 'school');
		$this->page->getBody()->addBreadcrumb('Create');
		/* Breadcrumbs */

		/* Page Maker */
		$this->page->getHead()->setDescription($metaDesc);
		$this->page->getHead()->setKeywords($metaKeywords);
		$this->page->setTitle($title);
		/* Page Maker */

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
		$data = Input::only('name', 'type', 'interest_rate',
		'school_term', 'is_active');
		/* Separation & Limitations of Data By Models */

		/* Validate Input */
		$messages = $this->school->messages();
		$rules = $this->school->rules();

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

                /* Query Creation & Fire */
		$mr = $this->school->create($data);
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
		$metaDesc = 'Details of school: ';	// meta description
		$metaKeywords = '';	// meta keywords
		$title = 'School Info';
		$with = [];
		/* Default Variables */

		/* Get School */
		$response = $this->school->view($id, $active, $fields, $with);
		/* Get School */

		/* JSON Response for API */
		if ($this->platform->isApi()) {
			return response()->json($response->toArray());
		}
		/* JSON Response for API */

		/* Enhance Meta Information and Title */
		$metaDesc .= addslashes($response->type);
		$metaKeywords .= 'details, school details, ' . addslashes($response->type) . ', ' . addslashes($response->name) . ' details';
		/* Enhance Meta Information and Title */

		/* Tab Navigation */
		$tabNav = $this->school->tabNavigation($id);
		$this->page->getBody()->addToData('tabNav', $tabNav);
		/* Tab Navigation */

		/* Breadcrumbs */
		$this->page->getBody()->addBreadcrumb('School', 'school');
		$this->page->getBody()->addBreadcrumb($response->type);
		/* Breadcrumbs */

		/* Page Maker */
		$this->page->getHead()->setDescription($metaDesc);
		$this->page->getHead()->setKeywords($metaKeywords);
		$this->page->setTitle($title);
		/* Page Maker */

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
		$metaDesc = 'Edit details of school: ';	// meta description
		$metaKeywords = '';	// meta keywords
		$title = 'Update School Info';
		$with = [];
		/* Default Variables */

		/* Get School */
		$response = $this->school->view($id, $active, $fields, $with);
		/* Get School */

		/* Enhance Meta Information and Title */
		$metaDesc .= addslashes($response->type);
		$metaKeywords .= 'manage, edit, manage school, edit school, edit ' . addslashes($response->name) . ', manage '. addslashes($response->name);
		/* Enhance Meta Information and Title */

		/* Breadcrumbs */
		$this->page->getBody()->addBreadcrumb('School', 'school');
		$this->page->getBody()->addBreadcrumb($response->type, 'school/' . $response->id);
		$this->page->getBody()->addBreadcrumb('Edit');
		/* Breadcrumbs */

		/* Page Maker */
		$this->page->getHead()->setDescription($metaDesc);
		$this->page->getHead()->setKeywords($metaKeywords);
		$this->page->setTitle($title);
		/* Page Maker */

		/* Set Data To View */
		$this->page->getBody()->addToData('school', $response);
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
		$data = Input::only('name', 'type', 'down_payment', 'amount', 'interest_rate',
		'school_term', 'annual_payment', 'is_active');
		/* Separation & Limitations of Data By Models */

		/* Validate Input */
		$messages = $this->school->messages();
		$rules = $this->school->rules('update', $id);

		$v = Validator::make($data, $rules, $messages);
		/* Validate Input */

		if ($v->fails()) { return redirect()->back()->withInput()->withErrors($v->errors()); }

		/* Query Creation & Fire */
		$mr = $this->school->update($id, $data);
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
        
        /**
	 * Save (create/update) resources in storage.
	 *
	 * @return Response
	 */
	public function bulkSave() {
		/* Default Variables */
		$data['file'] = Input::file('file');
		$rules = [
			'file' => 'required|mimes:xls,xlsx'
		];
		$messages = [
			'file.mimes' => 'File must be an excel file i.e. \'.xls\' or \'.xlsx\'',
			'file.required' => 'Please choose a file'
		];
		$report = [
			'fail' => [],
			'success' => []
		];
		/* Default Variables */

		/* Validate Input Data */
		$fileValidation = Validator::make($data, $rules, $messages);
		/* Validate Input Data */

		/* Redirect if Validations Fail */
		if ($fileValidation->fails()) { // no file
			return redirect()->back()->withInput()->withErrors($fileValidation->errors());
		}
		/* Redirect if Validations Fail */

		Excel::selectSheets('School')->load($data['file'], function($reader) use(&$report) {
			$messages = $this->school->messages();
			$results = $reader->all()->toArray();	// get file content
			//dd($results);
			foreach ($results as $entry) {
				/* Check if School Exists */
				$school = $this->school->findByType($entry['type']);
				/* Check if School Exists */

				if ($school) {
					$rules =  $this->school->rules('update', $school->id);

					$entryData = $school->toArray();
					$entryData['down_payment'] = !empty(trim($entry['down_payment'])) ? trim($entry['down_payment']) : 0.00;
					$entryData['amount'] = !empty(trim($entry['amount'])) ? trim($entry['amount']) : 0.00;
					$entryData['interest_rate'] = !empty(trim($entry['interest_rate'])) ? trim($entry['interest_rate']) : 0.00;
					$entryData['school_term'] = !empty(trim($entry['school_term'])) ? trim($entry['school_term']) : 0;	
					$entryData['annual_payment'] = !empty(trim($entry['annual_payment'])) ? trim($entry['annual_payment']) : 0.00;	

					/* Validate Data */
					$v = Validator::make($entryData, $rules, $messages);
					/* Validate Data */

					if ($v->fails()) {
						$report['fail'][$entry['type']] = [
							'messages' => $v->errors()->toArray()
						];

						continue;
					}

					$mr = $this->school->update($school->id, $entryData);

					$report['success'][] = $entry['type'];
				}
				else {
					$rules =  $this->school->rules();

					$entryData = [
						'name' => trim($entry['name']),
						'type' => trim($entry['type']),
						'down_payment' => !empty(trim($entry['down_payment'])) ? trim($entry['down_payment']) : 0.00,
						'amount' => !empty(trim($entry['amount'])) ? trim($entry['amount']) : 0.00,
						'interest_rate' => !empty(trim($entry['interest_rate'])) ? trim($entry['interest_rate']) : 0.00,
						'school_term' => !empty(trim($entry['school_term'])) ? trim($entry['school_term']) : 0,
						'annual_payment' => !empty(trim($entry['annual_payment'])) ? trim($entry['annual_payment']) : 0.00,
						'is_active' => 1,
					];

					/* Validate Data */
					$v = Validator::make($entryData, $rules, $messages);
					/* Validate Data */

					if ($v->fails()) {
						$report['fail'][$entry['type']] = [
							'messages' => $v->errors()->toArray()
						];

						continue;
					}

					$mr = $this->school->create($entryData);

					$report['success'][] = $entry['type'];
				}
			}
		});

		return redirect('school')->with(['report' => $report]);
	}
        
        /**
	 * Show the form for upload file to create/update resources.
	 *
	 * @return Response
	 */
	public function bulkUpload() {
		/* Default Variables */
		$metaDesc = 'Upload file to create and update schools';	// meta description
		$metaKeywords = 'upload, file, create, update, new, schools, upload file, create schools, update schools, create new schools';	// meta keywords
		$title = 'Upload Schools File';
		/* Default Variables */

		/* Breadcrumbs */
		$this->page->getBody()->addBreadcrumb('School', 'school');
		$this->page->getBody()->addBreadcrumb('Bulk Upload');
		/* Breadcrumbs */

		/* Page Maker */
		$this->page->getHead()->setDescription($metaDesc);
		$this->page->getHead()->setKeywords($metaKeywords);
		$this->page->setTitle($title);
		/* Page Maker */

		/* HTML View Response */
		return response()->view($this->viewBase . '.' . __FUNCTION__, ['page' => $this->page]);
		/* HTML View Response */
	}


	/**
	 * Method for datatables
	 *
	 * @return json
	 */
	public function datatables() {
		return $this->school->datatables();
	}    
}
