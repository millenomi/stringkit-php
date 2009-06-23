<?php

class SKFastLanesTests extends UnitTestCase {
	function testASCIIBufferFastLaneUsed() {
		$s = SKStr('Hello');
		$observer = new SKTestObserver();
		$observer->push();
		
		$enc = new SKASCIIEncoder();
		$x = $enc->encode($s);
		
		$observer->pop();
		$this->assertEqual($x, 'Hello');
		$this->assertTrue($observer->hasObserved(
			SKTestObserver::DidUseFastBufferOfEncodingFastLane,
			array(
				SKTestObserver::StringObject => $s,
				SKTestObserver::EncoderObject => $enc,
				SKTestObserver::EncodingName => kSKEncoding_ASCII
			)
		));
	}
	
	function testASCIIBufferFastLaneNotUsed() {
		$s = new SKArrayString(array(ord('H'), ord('e'), ord('l'), ord('l'), ord('o')));
		$observer = new SKTestObserver();
		$observer->push();
		
		$enc = new SKASCIIEncoder();
		$x = $enc->encode($s);
		
		$observer->pop();
		$this->assertEqual($x, 'Hello');
		$this->assertFalse($observer->hasObserved(
			SKTestObserver::DidUseFastBufferOfEncodingFastLane,
			array(
				SKTestObserver::StringObject => $s,
				SKTestObserver::EncoderObject => $enc,
				SKTestObserver::EncodingName => kSKEncoding_ASCII
			)
		));
	}
}