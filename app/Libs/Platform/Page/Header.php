<?php namespace App\Libs\Platform\Page;

/**
 * Class for page header i.e. the content for the header section e.g. logo,
 * banner, etc.
 */
class Header {
	private $elements;
	private $logo;
	private $menu;
	
	/**
	 * Contructor method
	 */
	public function __construct() {
		$this->elements = [];
		$this->logo = '';
		$this->menu = [];
	}
	
	/**
	 * Get method for $this->elements
	 * 
	 * @return array
	 */
	public function getElements($id = '') {
		if($id){
			return $this->elements[$id];
		}
		return $this->elements;
	}
	
	/**
	 * Get method for $this->logo
	 * 
	 * @return string
	 */
	public function getLogo() {
		return $this->logo;
	}
	
	/**
	 * Get method for $this->menu
	 * 
	 * @return array
	 */
	public function getMenu() {
		return $this->menu;
	}
	
	/**
	 * Set method for $this->elements
	 * 
	 * @param $key Element key
	 * @param $element Element
	 */
	public function setElement($key, $element) {
		$this->elements[$key] = $element;
	}
	
	/**
	 * Set method for $this->elements
	 * 
	 * @param array $elements
	 */
	public function setElements($elements) {
		$this->elements = $elements;
	}
	
	/**
	 * Set method for $this->logo
	 * @param string $logo
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
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
	 * Method to return the properties of the class in array format
	 * 
	 * @return array
	 */
	public function toArray() {
		return [
			'elements'=>$this->elements,
			'logo'=>$this->logo,
			'menu'=>$this->menu
		];
	}
}
