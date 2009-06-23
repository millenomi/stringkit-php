<?php

class SKProxiesTests extends UnitTestCase {
	function testSubstring() {
		$a = SKStr('HelloWorld');
		$b = new SKSubstring($a, 1, 3);
		
		$x = $b->iterator();
		$cp = array();
		while ($x->hasNext()) {
			$cp[] = $x->next();
		}
		
		$expectedCps = array(ord('e'), ord('l'), ord('l'));
		$this->assertEqual($cp, $expectedCps);
		
		$this->assertTrue(
			$b->isEqualToString(SKStr('ell')));
	}
	
	function testOverlongSubstring() {
		$a = SKStr('HelloWorld');
		$b = new SKSubstring($a, 1, 20000);
				
		$this->assertTrue(
			$b->isEqualToString(SKStr('elloWorld')));
	}

	function testSubstringOfSubstring() {
		$a = SKStr('HelloWorld');
		$b = new SKSubstring($a, 1, 3);
		$c = $b->substring(1,1);
		
		$this->assertTrue(
			$c->isEqualToString(SKStr('l')));
	}
	
}
