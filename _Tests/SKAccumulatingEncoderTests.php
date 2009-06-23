<?php

class SKAccumulatingEncoderTests extends UnitTestCase {
	function testISOLatin1() {
		$enc = new SKISOLatin1Encoder();
		
		// ASCII string
		$cps = array(ord('H'), ord('e'), ord('l'), ord('l'), ord('o'));
		$hello = new SKArrayString($cps);
		
		$s = $enc->encode($hello);
		$this->assertEqual($s, 'Hello');
		
		// ISO but not ASCII string
		$cps = array(ord('V'), ord('o'), ord('i'), ord('l'), 0xE0 /* à */);
		$hello = new SKArrayString($cps);
		
		$s = $enc->encode($hello);
		$this->assertEqual($s, 'Voil' . chr(0xE0));
		
		// non-ASCII, non-Latin 1 string
		$cps = array(ord('G'), ord('o'), ord(' '), 0x221E /* ∞ */);
		$hello = new SKArrayString($cps);
		
		$excepted = false; $s = null;
		try {
			$s = $enc->encode($hello);		
		} catch (SKNotRepresentableInEncodingException $e) {
			$excepted = true;
		}
		$this->assertEqual($s, null);
		$this->assertTrue($excepted);
	}
	
	function testASCII() {
		$enc = new SKASCIIEncoder();
		
		// ASCII string
		$cps = array(ord('H'), ord('e'), ord('l'), ord('l'), ord('o'));
		$hello = new SKArrayString($cps);
		
		$s = $enc->encode($hello);
		$this->assertEqual($s, 'Hello');
		
		// ISO but not ASCII string
		$cps = array(ord('V'), ord('o'), ord('i'), ord('l'), 0xE0 /* à */);
		$hello = new SKArrayString($cps);
		
		$excepted = false; $s = null;
		try {
			$s = $enc->encode($hello);		
		} catch (SKNotRepresentableInEncodingException $e) {
			$excepted = true;
		}
		$this->assertEqual($s, null);
		$this->assertTrue($excepted);
		
		// non-ASCII, non-Latin 1 string
		$cps = array(ord('G'), ord('o'), ord(' '), 0x221E /* ∞ */);
		$hello = new SKArrayString($cps);
		
		$excepted = false; $s = null;
		try {
			$s = $enc->encode($hello);		
		} catch (SKNotRepresentableInEncodingException $e) {
			$excepted = true;
		}
		$this->assertEqual($s, null);
		$this->assertTrue($excepted);
	}
}