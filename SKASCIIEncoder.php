<?php

class SKASCIIEncoder extends SKAccumulatingEncoder {
	function byteSequenceForCodePoint($cp) {
		if ($cp > 127)
			throw new SKNotRepresentableInEncodingException();
			
		return chr($cp);
	}
	
	function encode($string) {
		$b = $string->fastBufferOfEncoding(kSKEncoding_ASCII);
		
		if ($b) {
			$observer = SKTestObserver::currentObserver();
			if ($observer) $observer->observeEvent(
				SKTestObserver::DidUseFastBufferOfEncodingFastLane,
				array(
					SKTestObserver::StringObject => $string,
					SKTestObserver::EncoderObject => $this,
					SKTestObserver::EncodingName => kSKEncoding_ASCII
				)
			);
			
			return $b;
		}
		
		return parent::encode($string);
	}
}
