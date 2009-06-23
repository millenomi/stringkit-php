<?php

class SKSubstring extends SBString {
	private $Iterator;
	
	function __construct($string, $index, $length) {
		parent::__construct();
		$this->Iterator = $string->iteratorFromIndexWithLength($index, $length);
	}
	
	
}