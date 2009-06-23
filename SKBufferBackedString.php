<?php

abstract class SKBufferBackedString extends SKString {
	protected $Buffer;
	
	protected function __construct($buffer) {
		parent::__construct();
		$this->Buffer = $buffer;
	}
	
	abstract protected function codePointForBufferSegment($buf);
	
	public function fastBufferOfEncoding($encoding) {
		if ($this->bufferConformsToEncoding($encoding))
			return $this->Buffer;
		else
			return null;
	}
	
	protected function bufferConformsToEncoding($encoding) {
		return false;
	}
}
