<?php namespace App\Libs\Platform\Page;

/**
 * Class for page footer
 */
class Footer {
	private $copyright;	// for the copyright related text
	private $elements;	// store elements associated with the footer
	private $menu;	// store any menu associated with the footer
	private $powered;	// for 'powered by' related text
	
	/**
	 * Contructor method
	 */
	public function __construct() {
		$this->copyright = '';
		$this->elements = [];
		$this->powered = '';
		$this->menu = [];
	}
	
	/**
	 * Get method for $this->copyright
	 * 
	 * @return string
	 */
	public function getCopyright() {
		return $this->copyright;
	}
	
	/**
	 * Get method for $this->elements
	 * 
	 * @return array
	 */
	public function getElements() {
		return $this->elements;
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
	 * Get method for $this->powered
	 * 
	 * @return string
	 */
	public function getPowered() {
		return $this->powered;
	}
	
	/**
	 * Set method for $this->copyright
	 * 
	 * @param string
	 */
	public function SetCopyright($copyright) {
		$this->copyright = $copyright;
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
	 * Set method for $this->menu
	 * 
	 * @param array $menu
	 */
	public function setMenu($menu) {
		$this->menu = $menu;
	}
	
	/**
	 * Set method for $this->powered
	 * 
	 * @return string $powered
	 */
	public function setPowered($powered) {
		$this->powered = $powered;
	}
	
	/**
	 * Method to get all the properties of the class in array format
	 * 
	 * @return array
	 */
	public function toArray() {
		return [
			'copyright' => $this->copyright,
			'elements' => $this->elements,
			'menu' => $this->menu,
			'powered' => $this->powered
		];
	}
}
