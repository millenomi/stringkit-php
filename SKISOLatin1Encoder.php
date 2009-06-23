<?php

class SKISOLatin1Encoder extends SKAccumulatingEncoder {
	function byteSequenceForCodePoint($cp) {
		if ($cp > 255)
			throw new SKNotRepresentableInEncodingException();
			
		return chr($cp);
	}
	
	function encode($string) {
		$b = $string->fastBufferOfEncoding(kSKEncoding_ISOLatin1);
		return $b? $b : parent::encode($string);
	}
}
