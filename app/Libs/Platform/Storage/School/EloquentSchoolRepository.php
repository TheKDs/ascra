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

    /**
     * Contructor method
     *
     * @param School $model
     */
    public function __construct(School $model) {
        $this->model = $model;
    }

    /**
     * Method to fetch all the entries from the table
     *
     * @return collection
     */
    public function all() {
        return $this->model->all();
    }

    /**
     * Method to create a conditions QueryBuilder
     *
     * @param array $filters : array of filters
     * @param QueryBuilder $query
     * @return App\Models\School QueryBuilder
     */
    public function conditions($filters = [], $query = null) {
        if (!$query) {
            $query = $this->model->newQuery();
        }
        if (isset($filters['id'])) {
            $query->where('id', '=', $filters['id']);
        }
        if (isset($filters['search'])) {
            $query->where('type', 'LIKE', '%' . $filters['search'] . '%');
        }

        return $query;
    }

    /**
     * Count of filtered list
     *
     * @param array $filters
     * @return integer
     */
    public function count($filters = []) {
        $query = $this->model->newQuery();

        if ($filters) {
            $query = $this->conditions($filters, $query);
        }

        return $query->count();
    }

    /**
     * Method to create an entry into the database
     *
     * @param array $data : array containing the new entry's data
     * @return App\Models\School
     */
    public function create($data) {
        $data = cleanUpArray($data); // sanitize the data

        return $this->model->create($data);
    }

    /**
     * Method for datatables
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function datatables() {
        $result = $this->model->select(['is_active', 'name', 'address', 'mobile', 'id']);

        if (Input::has('name')) {
            $result->where('name', '=', Input::get('name'));
        }

        return Datatables::of($result)->make();
    }

    /**
     * Method for datatables
     *
     * @return Illuminate\Http\JsonResponse
     */
    /*public function datatablesTutorial() {
        $result = $this->model
                ->select([
                    'name', 'type', 'scrip',
                    'price', 'credit_rating', 'interest_rate', 'face_value',
                    'allotment_date', 'redemption_date', 'id'
                ])
                ->where('loans.is_active', '=', 1);

        if (Input::has('credit_rating')) {
            $result->where('credit_rating', 'LIKE', '%' . Input::get('credit_rating') . '%');
        }
        if (Input::has('name')) {
            $result->where('name', 'LIKE', '%' . Input::get('name') . '%');
        }
        if (Input::has('scrip_code')) {
            $result->where('scrip_code', 'LIKE', '%' . Input::get('scrip_code') . '%');
        }
        if (Input::has('type')) {
            $result->where('type', '=', Input::get('type'));
        }

        return Datatables::of($result)->make();
    }*/

    /**
     * Method for datatables
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function datatablesWww($status=true, $filter=[]) {
        $player_id = Auth::player()->get()->id;
        /* Display all the data */
        /* Remove the below single-line comment if data is needed from based on game date */
        
        // $currentGame = app('App\Libs\Platform\Storage\Player\PlayerRepository')->getCurrentGame($player_id);
        // $currentGameDate = app('App\Libs\Platform\Storage\GameDate\GameDateRepository')->getCurrentGameDate($currentGame->id);

        // if (!empty($currentGame)) {
        //     /* Get Schools */
        //     $loanListing = app('App\Libs\Platform\Storage\GameDateSchool\GameDateSchoolRepository')->listing(0,true, ['loan_id'], ['game_date_id' => $currentGameDate->id]);
        //     if (count($loanListing) > 0) {
        //         foreach ($loanListing as $loan) {
        //             $loanIds[] = $loan->loan_id;
        //         }
        //     }
        //     /* Get Loans */
        // }

        // if ($currentGameDate->is_simulation) {
        //     $result = $this->model
        //             ->select([
        //                 'loans.name',
        //                 'loans.type',
        //                 'loans.down_payment',
        //                 'loans.amount',
        //                 'loans.interest_rate',
        //                 'loans.loan_term',
        //                 'loans.annual_payment',
        //                 'loans.id AS id'
        //             ])
        //             ->join('game_date_loans', 'loans.id', '=', 'game_date_loans.loan_id')
        //             ->where('loans.is_active', '=', 1);
        //             ->where('game_date_loans.game_date_id', '=', $currentGameDate->id);
        // } else {
        //     $result = $this->model
        //             ->select([
        //                 'name', 'type', 'down_payment',
        //                 'amount', 'interest_rate', 'loan_term', 'annual_payment',
        //                 'id'
        //             ])
        //             ->where('loans.is_active', '=', 1);
        // }

        $result = $this->model
                    ->select([
                        'name', 'type', 'down_payment',
                        'amount', 'interest_rate', 'loan_term', 'annual_payment',
                        'id'
                    ])
                    ->where('loans.is_active', '=', 1);

        /*if (!empty($loanIds)) {
            $result->whereIn('loans.id', $loanIds);
        }*/
        
        if (Input::has('type')) {
            $result->where('type', '=', Input::get('type'));
        }

        if(!empty($filter)) {
            if($filter['homeLoanRemove']){
                $result->where('loans.type', '!=', 'Home Loan');
            }
            if($filter['carLoanRemove']){
                $result->where('loans.type', '!=', 'Car Loan');
            }
            if($filter['personalLoanRemove']) {
                $result->where('loans.type', '!=', 'Personal Loan');
            }            
        }

        if($status) {
           return Datatables::of($result)->make(); 
       }else{
            return $result->get();// don't show home loan in listing
       }
        
    }

    /**
     * Method to delete an existing entry from the database
     *
     * @param int $id : id of the entry
     * @return boolean
     */
    public function delete($id) {
        $resource = $this->find($id);
        return $resource->delete();
    }

    /**
     * Method to fetch and return a particular record from the table by 'id'
     *
     * @param int $id : id of the entry
     * @return App\Models\Loan
     */
    public function find($id) {
        return $this->model->find($id);
    }
    
    /**
     * Method to find an entry by scrip code
     *
     * @param string
     * @return App\Models\Loan
     */
    public function findByType($type) {
        return $this->model->where('type', 'LIKE', '%' .$type. '%')->first();
    }

    /**
     * Get a paginated listing
     *
     * @param int $limit
     * @param boolean $active
     * @param array $fields
     * @param array $filters
     * @param array $sort
     * @param array $with
     * @param int $page
     * @return collection
     */
    public function listing($limit = 25, $active = true, $fields = [], $filters = [], $sort = ['type'], $with = [], $page = 0) {
        $query = $this->model->newQuery();

        if ($active) {
            $query->where('is_active', '=', 1);
        }
        if (!$fields) {
            $fields = ['*'];
        }
        if ($filters) {
            $query = $this->conditions($filters, $query);
        }

        if ($with) {
            $with = $this->model->processWithSelects($with);
            $query->with($with);
        }

        /* Sorts */
        foreach ($sort as $key => $val) {
            if (is_string($key)) {
                $query->orderBy($key, $val);
            } else {
                $query->orderBy($val);
            }
        }
        /* Sorts */

        /* Pagination */
        if ($limit) {
            if (!$page) {
                $page = Input::has('page') ? abs(Input::get('page')) : 1;
            }
            $skip = ($page - 1) * $limit;
            $query->take($limit)->skip($skip);
        }
        /* Pagination */

        return $query->get($fields);
    }

    /**
     * Method to get validation messages
     *
     * @return array
     */
    public function messages() {
        return [
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Invalid Amount',
            'down_payment.numeric' => 'Invalid Down Payment',
            'interest_rate.required' => 'Interest Rate is required',
            'interest_rate.between' => 'Interest Rate must be between 0 and 100',
            'interest_rate.numeric' => 'Invalid Tax Rate',
            'is_active.boolean' => 'Loan must be set as active or inactive',
            'loan_term.required' => 'Loan Term is required',
            'loan_term.numeric' => 'Invalid Loan Term',
            'is_active.required' => 'Active status is required',
            'type.max' => 'Type cannot exceed 100 characters',
            'type.required' => 'Type is required',
            'name.required' => 'Name is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($action = '', $id = null) {
        $rules = [
            'name' => 'required',
            //'amount' => 'required|numeric',
            //'down_payment' => 'numeric',
            'interest_rate' => 'required|numeric|between:0,99.99',
            'is_active' => 'required|boolean',
            'loan_term' => 'required|numeric',
            'type' => 'required|max:100',
        ];

        return $rules;
    }

    /**
     * Method to setup the navigation tabs for the show/details page
     *
     * @param int $id
     * @return array
     */
    public function tabNavigation($id) {
        return [
            ['key' => 'loan', 'name' => 'Overview', 'url' => 'loan/' . $id]
        ];
    }

    /**
     * Method to update an existing entry in the database
     *
     * @param int $id : id of the entry
     * @param array $data : array containing the entry's updated data
     * @return App\Models\Loan
     */
    public function update($id, $data) {
        $data = cleanUpArray($data); // sanitize the data

        $resource = $this->model->find($id);

        if ($resource->update($data)) {
            return $resource;
        }
        return false;
    }

    /**
     * Method to fetch an entry along with the respective data based on the criteria
     *
     * @param int $id
     * @param boolean $active
     * @param array $fields
     * @param array $with
     * @return App\Models\Loan
     * @throws Exception
     */
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
