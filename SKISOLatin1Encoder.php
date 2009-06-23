<?php

class SKISOLatin1Encoder extends SKAccumulatingEncoder {
	function byteSequenceForCodePoint($cp) {
		if ($cp > 255)
			throw new SKNotRepresentableInEncodingException();
			
		return chr($cp);
	}
}
