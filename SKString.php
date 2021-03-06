<?php

abstract class SKString {
	abstract function iteratorWithRange($index, $length);
	abstract function length();
	
	protected function __construct() {}
	
	function iterator() {
		return $this->iteratorWithRange(0, $this->length());
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
	
	public function fastBufferOfEncoding($encoding) {
		return null;
	}
	
	public function fastBufferOfEncodingWithRange($encoding, $index, $length) {
		return null;
	}
	
	public function fastSubstringsOrBuffersWithEncoding($encoding) {
		$x = $this->fastBufferOfEncoding($encoding);
		return $x? array($x) : array($this);
	}
	
	public function substring($index, $length) {
		return new SKSubstring($this, $index, $length);
	}
}
