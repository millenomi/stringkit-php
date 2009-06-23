<?php

abstract class SKAccumulatingEncoder extends SKEncoder {
	abstract function byteSequenceForCodePoint($cp);
	
	function encode($string) {
		$iterator = $string->iterator();
		$a = '';
		
		while ($iterator->hasNext())
			$a .= $this->byteSequenceForCodePoint($iterator->next());
		
		return $a;
	}
}