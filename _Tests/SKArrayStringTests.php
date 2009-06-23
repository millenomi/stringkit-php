<?php

class SKArrayStringTests extends UnitTestCase {

	function setUp() {
		$this->CodePointsArray = array(ord('H'), ord('e'), ord('l'), ord('l'), ord('o'));
		$this->HelloString = new SKArrayString($this->CodePointsArray);
	}

	function testIterateAll() {
		$iterator = $this->HelloString->iterator();
		$a = array();
		
		while ($iterator->hasNext()) {
			$a[] = $iterator->next();
		}
		
		$this->assertEqual($a, $this->CodePointsArray);
	}
	
	function testIterateSome() {
		$iterator = $this->HelloString->iteratorWithRange(1, 3);
		$a = array();
		
		while ($iterator->hasNext()) {
			$a[] = $iterator->next();
		}
		
		$this->assertEqual($a, array(ord('e'), ord('l'), ord('l')));
	}
	
	function testLength() {
		$this->assertEqual($this->HelloString->length(), 5);
	}
	
	function testEquality() {
		$secondString = new SKArrayString($this->CodePointsArray);
		$this->assertTrue($this->HelloString->isEqualToString($secondString));
	}
	
	function testInequality() {
		// same length, completely different
		$secondString = new SKArrayString(array(ord('1'), ord('2'), ord('3'), ord('4'), ord('5')));
		$this->assertFalse($this->HelloString->isEqualToString($secondString));
		
		// same length, same at the beginning
		$secondString = new SKArrayString(array(ord('H'), ord('e'), ord('f'), ord('l'), ord('o')));
		$this->assertFalse($this->HelloString->isEqualToString($secondString));

		// same length, same at the end
		$secondString = new SKArrayString(array(ord('H'), ord('e'), ord('l'), ord('l'), ord('b')));
		$this->assertFalse($this->HelloString->isEqualToString($secondString));

		// differing length, completely different
		$secondString = new SKArrayString(array(ord('1'), ord('2')));
		$this->assertFalse($this->HelloString->isEqualToString($secondString));

		// differing length, portions matching
		$secondString = new SKArrayString(array(ord('H'), ord('e'), ord('l')));
		$this->assertFalse($this->HelloString->isEqualToString($secondString));
	}
	
	function testEncoding() {
		$e = new SKASCIIEncoder();
		$s = $e->encode($this->HelloString);
		
		$this->assertEqual($s, 'Hello');
	}
}