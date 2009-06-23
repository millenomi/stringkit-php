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
		
		foreach ($parts as $part) {
			if (is_object($part))
				$buf .= parent::encode($part);
			else
				$buf .= $part;
		}
		
		return $buf;
	}
}
