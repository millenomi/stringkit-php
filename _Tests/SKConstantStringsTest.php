<?php

class SKConstantStringsTest extends UnitTestCase {
	function testASCIIStrings() {		
		$codePoints = array(ord('H'), ord('e'), ord('l'), ord('l'), ord('o'));
		$s = SKStr("Hello");
		$s2 = new SKArrayString($codePoints);
		
		$this->assertEqual($s->length(), 5);
		
		$iterator = $s->iterator();
		$cp = array(); while ($iterator->hasNext())
			$cp[] = $iterator->next();
		
		$this->assertEqual($cp, $codePoints);
		
		$this->assertTrue($s->isEqualToString($s2));
		$this->assertTrue($s2->isEqualToString($s));
		
		$enc = new SKASCIIEncoder();
		$x = $enc->encode($s);
		$this->assertEqual($x, 'Hello');
	}
}
