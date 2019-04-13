<?php namespace App\Libs\Platform\Page;

/**
 * Class for the page body
 */
class Body {
	private $breadcrumbs;	// store breadcrumbs associated with the page
	private $data;	// store data associated with the page
	private $menu;	// store menu associated with the page
	private $title;		// store page title
	
	/**
	 * Contructor method
	 * 
	 * @param array $data
	 */
	public function __construct($data = []) {
		$this->breadcrumbs = [];
		$this->data = $data;
		$this->menu = [];
	}
	
	/**
	 * Method to add a breadcrumb to $this->breadcrumb
	 * 
	 * @param string $title
	 * @param string $url
	 */
	public function addBreadcrumb($title, $url = '') {
		$this->breadcrumbs[] = ['title'=>$title, 'url'=>$url];
	}
	
	/**
	 * Method to add a key-value pair to $this->data
	 * 
	 * @param string $key
	 * @param type $value
	 */
	public function addToData($key, $value) {
		$this->data[$key] = $value;
	}
	
	/**
	 * Get method for $this->breadcrumbs
	 * 
	 * @return array
	 */
	public function getBreadcrumbs() {
		return $this->breadcrumbs;
	}
	
	/**
	 * Get method for $this->data
	 * 
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Method to get value corresponding to a key from $this->data
	 * 
	 * @param string $key
	 * @return string/object/array/null i.e. value corresponding to the 'key'
	 */
	public function getDataByKey($key) {
		if (array_key_exists($key, $this->data)) { return $this->data[$key]; }
		else { return null; }
	}
	
	/**
	 * Get method for $this->menu
	 * 
	 * @return array $this->menu
	 */
	public function getMenu() {
		return $this->menu;
	}
	
	/**
	 * Get method for $this->title
	 * 
	 * @return string $this->title
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Set method for $this->breadcrumbs
	 * 
	 * @param array $breadcrumbs
	 */
	public function setBreadcrumbs($breadcrumbs) {
		$this->breadcrumbs = $breadcrumbs;
	}
	
	/**
	 * Set method for $this->data
	 * 
	 * @param array $data
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 * Set method for $this->menu
	 * 
	 * @param array $menu
	 */
	public function setMenu($menu) {
		$this->menu = $menu;
	}
	
	/**
	 * Set method for $this->title
	 * 
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * Method to get all the properties of the class in array format
	 * 
	 * @return array
	 */
	public function toArray() {
		return [
			'breadcrumbs' => $this->breadcrumbs,
			'data' => $this->data,
			'menu' => $this->menu
		];
	}
}
