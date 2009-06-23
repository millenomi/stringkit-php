<?php

class SKISOLatin1ConstantString extends SKConstantLengthBufferBackedString {
	private $IsASCII;
	
	public function __construct($buffer, $flags) {
		parent::__construct($buffer, 1 /* one byte per char */);
		$this->IsASCII = ($flags & kSKConstantStringIsASCII);
	}
	
	protected function codePointForBufferSegment($buf) {
		return ord($buf);
	}
	
	protected function bufferConformsToEncoding($encoding) {
		if ($encoding == kSKEncoding_ISOLatin1) return true;
		if ($encoding == kSKEncoding_ASCII) return $this->IsASCII;
		return false;
	}
}
