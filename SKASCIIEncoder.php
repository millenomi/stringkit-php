<?php

class SKASCIIEncoder extends SKAccumulatingEncoder {
	function byteSequenceForCodePoint($cp) {
		if ($cp > 127)
			throw new SKNotRepresentableInEncodingException();
			
		return chr($cp);
	}
}
