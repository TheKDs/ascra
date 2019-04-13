<?php namespace App\Libs\Platform\Page;

/**
 * Class for page and its properties
 */
class PageManager {
	private $action = '';	// CRUD action
	private $activePage = '';	// active page of the menu
	private $activeSection = '';	// active section of menu
	private $body = null;	// \Platform\Page\Body object
	private $controller = '';	// name of the controller
	private $footer = null;	// \Platform\Page\Footer object
	private $head = null;	// \Platform\Page\Head object
	private $header = null;	// \Platform\Page\Header object
	private $pageType = '';	// type of page
	private $platform = null;
	
	/**
	 * Constructor method
	 */
	public function __construct($controller = '', $action = '') {
		$this->action = $action;
		$this->activePage = '';
		$this->activeSection = '';
		$this->body = new Body();
		$this->controller = $controller;
		$this->footer = new Footer();
		$this->head = new Head();
		$this->header = new Header();
		$this->pageType = '';
	}
	
	/**
	 * Build the url
	 * 
	 * @param type $platformKey
	 * @return string
	 */
	public function buildUrl($platformKey) {
		return $this->platform->getProtocol() . $this->platform->getPlatformType($platformKey) . $this->platform->getUrl(); 
	}
	
	/**
	 * Get method for $this->action
	 * 
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * Get method for $this->activePage
	 * 
	 * @return string
	 */
	public function getActivePage() {
		return $this->activePage;
	}
	
	/**
	 * Get method for $this->activeSection
	 * 
	 * @return string
	 */
	public function getActiveSection($level = null) {
		return (!is_null($level) && isset($this->activeSection[$level]))? $this->activeSection[$level] : $this->activeSection;
	}
	
	/**
	 * Get method for $this->body
	 * 
	 * @return Body
	 */
	public function getBody() {
		return $this->body;
	}
	
	/**
	 * Get method for $this->controller
	 * 
	 * @return string
	 */
	public function getController() {
		return $this->controller;
	}
	
	/**
	 * Get method for $this->footer
	 * 
	 * @return Footer
	 */
	public function getFooter() {
		return $this->footer;
	}
	
	/**
	 * Get method for $this->head
	 * 
	 * @return Head
	 */
	public function getHead() {
		return $this->head;
	}
	
	/**
	 * Get method for $this->header
	 * 
	 * @return Header
	 */
	public function getHeader() {
		return $this->header;
	}
	
	/**
	 * Get method for $this->pageType
	 * 
	 * @return string
	 */
	public function getPageType() {
		return $this->pageType;
	}
	
	/**
	 * Get method for $this->platform
	 * 
	 * @return Platform
	 */
	public function getPlatform() {
		return $this->platform;
	}
	
	/**
	 * Method to check if the neccessary properties of the class have been
	 * populated
	 * 
	 * @return boolean
	 */
	public function isReady() {
		return ($this->body && $this->header && $this->footer && $this->head)? true : false;
	}
	
	/**
	 * Set method for $this->activeSection
	 * 
	 * @param string $activeSection
	 */
	public function pushActiveSection($activeSection) {
		$this->activeSection[] = $activeSection;
	}
	
	/**
	 * Set method for $this->action
	 * 
	 * @param string $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}
	
	/**
	 * Set method for $this->activePage
	 * 
	 * @param string $activePage
	 */
	public function setActivePage($activePage) {
		$this->activePage = $activePage;
	}
	
	/**
	 * Set method for $this->activeSection
	 * 
	 * @param string $activeSection
	 */
	public function setActiveSection($activeSection, $level = null) {
		if (is_null($level)) {
			$this->activeSection = !is_array($activeSection)? [$activeSection] : $activeSection;
		}
		else { $this->activeSection[$level] = $activeSection; }
	}
	
	/**
	 * Set method for $this->body
	 * 
	 * @param Body $body
	 */
	public function setBody($body) {
		$this->body = $body;
	}
	
	/**
	 * Set method for $this->controller
	 * 
	 * @param string $controller
	 */
	public function setController($controller) {
		$this->controller = $controller;
	}
	
	/**
	 * Set method for $this->footer
	 * 
	 * @param Footer $footer
	 */
	public function setFooter($footer) {
		$this->footer = $footer;
	}
	
	/**
	 * Set method for $this->head
	 * 
	 * @param Head $head
	 */
	public function setHead($head) {
		$this->head = $head;
	}
	
	/**
	 * Set method for $this->header
	 * 
	 * @param Header $header
	 */
	public function setHeader($header) {
		$this->header = $header;
	}
	
	/**
	 * Set method for $this->pageType
	 * 
	 * @param string $pageType
	 */
	public function setPageType($pageType) {
		$this->pageType = $pageType;
	}
	
	/**
	 * Set method for $this->platform
	 * 
	 * @param string $platform
	 */
	public function setPlatform($platform) {
		$this->platform = $platform;
	}
	
	/**
	 * Set method for Body $title and Head $title - same value
	 * 
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->body->setTitle($title);
		$this->head->setTitle($title);
	}
	
	/**
	 * Set method for Head $titlePrefix - same value
	 * 
	 * @param string $titlePostfix
	 */
	public function setTitlePostfix($titlePostfix) {
		$this->head->setTitlePostfix($titlePostfix);
	}
	
	/**
	 * Set method for Head $titlePrefix - same value
	 * 
	 * @param string $titlePrefix
	 */
	public function setTitlePrefix($titlePrefix) {
		$this->head->setTitlePrefix($titlePrefix);
	}
	
	/**
	 * Method to get all the properties of the class in array format
	 * 
	 * @return array
	 */
	public function toArray() {
		return [
			'action' => $this->action,
			'activePage' => $this->activePage,
			'activeSection' => $this->activeSection,
			'body' => $this->body->toArray(),
			'controller' => $this->controller,
			'footer' => $this->footer->toArray(),
			'head' => $this->head->toArray(),
			'header' => $this->header->toArray(),
			'pageType' => $this->pageType
		];
	}
}
