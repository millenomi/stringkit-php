<?php

abstract class SKBufferBackedString extends SKString {
	protected $Buffer;
	
	protected function __construct($buffer) {
		parent::__construct();
		$this->Buffer = $buffer;
	}
}
