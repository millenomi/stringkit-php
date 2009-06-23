<?php

abstract class SKConstantLengthBufferBackedString extends SKBufferBackedString {
	private $Pace;
	
	protected function __construct($buffer, $pace) {
		parent::__construct($buffer);
		$this->Pace = $pace;
	}
	
	public function bufferSegmentForCharacterIndex($i) {
		if ($this->Pace == 1)
			$x = $this->Buffer[$i];
		else
			$x = substr($this->Buffer, $i * $this->Pace, $this->Pace);
			
		return $x;
	}
	
	public function codePointAtIndex($i) {
		return $this->codePointForBufferSegment($this->bufferSegmentForCharacterIndex($i));
	}
	
	function iteratorFromIndexWithLength($index, $length) {
		return new _SKConstantLengthEncodedCharactersIterator($this, $index, $length);
	}
	
	function length() {
		// echo __FUNCTION__ . ": buffer len = " . strlen($this->Buffer) . ", pace = " . $this->Pace . "\n";
		return strlen($this->Buffer) / $this->Pace;
	}
	
	public function fastBufferOfEncodingFromIndexWithLength($encoding, $index, $length) {
		if ($this->bufferConformsToEncoding($encoding)) {
			$indexByte = $index * $this->Pace;
			$lengthInBytes = $length * $this->Pace;
			
			$subbuf = substr($this->Buffer, $indexByte, $lengthInBytes);
			return $subbuf;
		} else
			return parent::fastBufferOfEncodingFromIndexWithLength($encoding, $index, $length);
	}
}

class _SKConstantLengthEncodedCharactersIterator implements SKCharactersIterator {
	private $String;
	private $Current;
	
	function __construct($string, $index, $length) {
		$this->String = $string;
		$lengthOfString = $string->length();

		$this->Current = $index;
		if ($this->Current < 0)
			$this->Current = 0;
			
		$this->LastIndex = $this->Current + $length - 1;
		if ($this->LastIndex >= $lengthOfString)
			$this->LastIndex = $lengthOfString - 1;
		// echo __FUNCTION__ . ": iterates from {$this->Current} to {$this->LastIndex} included.\n";
		// echo "for index $index, length $length\n";
	}
	
	function hasNext() {
		$result = $this->Current <= $this->LastIndex;
		// echo __FUNCTION__ . ": {$this->Current} <= {$this->LastIndex} ($result)\n";
		return $result;
	}
	
	function next() {
		$c = $this->String->codePointAtIndex($this->Current);
		$this->Current++;
		return $c;
	}
}
