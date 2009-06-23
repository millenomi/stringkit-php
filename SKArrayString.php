<?php

class SKArrayString extends SKString {
	private $CodePoints;
	
	function __construct(array $codePoints) {
		parent::__construct();
		$this->CodePoints = $codePoints;
	}
	
	function iteratorFromIndexWithLength($index, $length) {
		return new _SKArrayCharactersIterator($this->CodePoints, $index, $length);
	}
	
	function length() {
		return sizeof($this->CodePoints);
	}
}

class _SKArrayCharactersIterator implements SKCharactersIterator {
	private $Array;
	private $Current;
	
	function __construct($array, $index, $length) {
		$this->Array = $array;

		$this->Current = $index;
		if ($this->Current < 0)
			$this->Current = 0;
			
		$this->LastIndex = $this->Current + $length - 1;
		if ($this->LastIndex >= sizeof($array))
			$this->LastIndex = sizeof($array) - 1;
		// echo __FUNCTION__ . ": iterates from {$this->Current} to {$this->LastIndex} included.\n";
		// 		echo "for index $index, length $length\n";
	}
	
	function hasNext() {
		$result = $this->Current <= $this->LastIndex;
		// echo __FUNCTION__ . ": {$this->Current} <= {$this->LastIndex} ($result)\n";
		return $result;
	}
	
	function next() {
		$c = $this->Array[$this->Current];
		$this->Current++;
		return $c;
	}
}
