<?php namespace App\Libs\Platform\Page;

/**
 * Class for page head i.e. content to be displayed in the '<head>' tag
 */
class Head {
	private $description;	// meta description of the page
	private $keywords;	// meta keywords of the page
	private $ogTags;
	private $title;	// page title
	private $titlePrefix;
	
	/**
	 * Constructor method
	 * 
	 * @param string $title
	 * @param string $keywords
	 * @param string $description
	 */
	public function __construct($title='', $keywords='', $description='', $titlePrefix = '', $titlePostfix = '', $ogTags = []) {
		$this->description = $description;
		$this->keywords = $keywords;
		$this->title = $title;
		$this->titlePrefix = $titlePrefix;
		$this->titlePostfix = $titlePostfix;
		$this->ogTags = $ogTags;
	}
	
	/**
	 * Get method for $this->description
	 * 
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Get method for $this->keywords
	 * 
	 * @return string
	 */
	public function getKeywords() {
		return $this->keywords;
	}
	
	/**
	 * Get method for og tags
	 * 
	 * @param string $tag
	 */
	public function getOgTag($tag) {
		return (isset($this->ogTags[$tag])) ? $this->ogTags[$tag] : '';
	}
	
	/**
	 * Get method for $this->title
	 * 
	 * @return string
	 */
	public function getTitle() {	
		$title = $this->title;
		
		if ($this->titlePrefix) { $title = $this->titlePrefix . ' - ' . $title; }
		if ($this->titlePostfix) { $title = $title . ' - ' . $this->titlePostfix; }
		
		return  $title;
	}
	
	/**
	 * Set method for description property
	 * 
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * Set method for keywords property
	 * 
	 * @param string $keywords
	 */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}
	
	/**
	 * Set method for og tags
	 * 
	 * @param string $tag, $value
	 */
	public function setOgTag($tag, $value) {
		$this->ogTags[$tag] = $value;
	}
	
	/**
	 * Set method for title property
	 * 
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * Set method for title property
	 * 
	 * @param string $titlePostfix
	 */
	public function setTitlePostfix($titlePostfix) {
		$this->titlePostfix = $titlePostfix;
	}
	
	/**
	 * Set method for title property
	 * 
	 * @param string $titlePrefix
	 */
	public function setTitlePrefix($titlePrefix) {
		$this->titlePrefix = $titlePrefix;
	}
	
	/**
	 * Method to return the properties of the class in array format
	 * 
	 * @return array
	 */
	public function toArray() {
		return [
			'description' => $this->description,
			'keywords' => $this->keywords,
			'titlePrefix' => $this->titlePrefix,
			'title' => $this->title
		];
	}
}
