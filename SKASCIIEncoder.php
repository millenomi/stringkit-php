<?php

class SKASCIIEncoder extends SKAccumulatingEncoder {
	function byteSequenceForCodePoint($cp) {
		if ($cp > 127)
			throw new SKNotRepresentableInEncodingException();
			
		return chr($cp);
	}
	
	function encode($string) {
		$parts = $string->fastSubstringsOrBuffersWithEncoding(kSKEncoding_ASCII);
		$buf = '';
		$fastlaned = false;
		
		foreach ($parts as $part) {
			if (is_object($part)) {
				$buf .= parent::encode($part);
			} else {
				$buf .= $part;
				$fastlaned = true;
			}
		}
		
		$observer = SKTestObserver::currentObserver();
		if ($fastlaned && $observer) $observer->observeEvent(
			SKTestObserver::DidUseFastBufferOfEncodingFastLane,
			array(
				SKTestObserver::StringObject => $string,
				SKTestObserver::EncoderObject => $this,
				SKTestObserver::EncodingName => kSKEncoding_ASCII
			)
		);
		
		return $buf;
	}
}
