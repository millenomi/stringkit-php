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
		return $this->String->iteratorFromIndexWithLength($this->Index, $this->Length);
	}
	
	function iteratorFromIndexWithLength($index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->iteratorFromIndexWithLength($index, $length);
	}
	
	function length() {
		return $this->Length;
	}
	
	function substring($index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->substring($index, $length);
	}
	
	public function fastBufferOfEncodingFromIndexWithLength($encoding, $index, $length) {
		$this->getRangeInOriginalStringForRange($index, $length);
		return $this->String->fastBufferOfEncodingFromIndexWithLength($encoding, $index, $length);
	}
	
	public function fastBufferOfEncoding($encoding) {
		$buf = $this->String->fastBufferOfEncodingFromIndexWithLength($encoding, $this->Index, $this->Length);
		return $buf;
	}
}