<?php
/**
 * This field lets you put an arbitrary piece of HTML into your forms.
 * 
 * <b>Usage</b>
 * 
 * <code>
 * new LiteralField (
 *    $name = "literalfield",
 *    $content = '<b>some bold text</b> and <a href="http://silverstripe.com">a link</a>'
 * )
 * </code>
 * 
 * @package forms
 * @subpackage fields-dataless
 */
class LiteralField extends DatalessField {
	
	/**
	 * @var string $content
	 */
	protected $content;
	
	function __construct($name, $content) {
		$this->content = $content;
		
		parent::__construct($name);
	}
	
	function FieldHolder($properties = array()) {
		if(is_object($this->content)) {
			$obj = $this->content;
			if($properties)
				$obj = $obj->customise($properties);
			return $obj->forTemplate();
		} else {
			return $this->content;
		}
	}

	function Field($properties = array()) {
		return $this->FieldHolder($properties);
	}

	/**
	 * Sets the content of this field to a new value
	 *
	 * @param string $content
	 */
	function setContent($content) {
		$this->content = $content;
		return $this;
	}
	
	/**
	 * @return string
	 */
	function getContent() {
		return $this->content;
	}
	
	/**
	 * Synonym of {@link setContent()} so that LiteralField is more compatible with other field types.
	 */
	function setValue($value) {
		$this->setContent($value);
		return $this;
	}

	function performReadonlyTransformation() {
		$clone = clone $this;
		$clone->setReadonly(true);
		return $clone;
	}

}
