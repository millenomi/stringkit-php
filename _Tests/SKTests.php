<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR .
	'simpletest' . DIRECTORY_SEPARATOR .
	'autorun.php';

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR .
	'..' . DIRECTORY_SEPARATOR .
	'SK.php';
	
chdir(dirname(__FILE__));
	
class SKTests extends TestSuite {
	function __construct() {
		parent::TestSuite('All StringKit Tests');
		
		$this->addFile('SKArrayStringTests.php');
		$this->addFile('SKAccumulatingEncoderTests.php');
	}
}
