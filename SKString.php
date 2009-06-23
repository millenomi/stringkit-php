<?php

abstract class SKString {
	abstract function iteratorFromIndexWithLength($index, $length);
	abstract function length();
	
	function __construct() {}
	
	function iterator() {
		return $this->iteratorFromIndexWithLength(0, $this->length());
	}
	
	function isEqualToString($string) {
		$a = $this->iterator();
		$b = $string->iterator();
		
		while ($a->hasNext() && $b->hasNext()) {
			$aC = $a->next();
			$bC = $b->next();
			
			if ($aC != $bC) return false;
		}
		
		return !$a->hasNext() && !$b->hasNext();
	}
}
