<?php

class SKSubstring extends SKString {
	private $String;
	private $Index;
	private $Length;
	
	function __construct($string, $index, $length) {
		parent::__construct();
		$this->String = $string;
		$this->Index = $index;
		
		$l = $string->length();
		if ($index + $length > $l)
			$this->Length = $l - $index;
		else
			$this->Length = $length;
	}
	
	function getRangeInOriginalStringForRange(&$index, &$length) {
		$index += $this->Index;
		if ($index + $length >= $this->Length)
			$length = $this->Length - $index;
	}
	
	function iterator() {
		return $this->String->iteratorWithRange($this->Index, $this->Length);
	}
	
	function iteratorWithRange($index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->iteratorWithRange($index, $length);
	}
	
	function length() {
		return $this->Length;
	}
	
	function substring($index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->substring($index, $length);
	}
	
	public function fastBufferOfEncodingWithRange($encoding, $index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->fastBufferOfEncodingWithRange($encoding, $index, $length);
	}
	
	public function fastBufferOfEncoding($encoding) {
		$buf = $this->String->fastBufferOfEncodingWithRange($encoding, $this->Index, $this->Length);
		return $buf;
	}
}