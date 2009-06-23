<?php

abstract class SKEncoder {
	public function __construct() {}
	
	abstract function encode($string);
}