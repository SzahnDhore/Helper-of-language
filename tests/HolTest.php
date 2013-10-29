<?php

// --- Includes the main language file.
require_once dirname(__FILE__).'/../src/HolQaH/lang/class.language.php';

// --- Test class.
class HolTest extends PHPUnit_Framework_TestCase {

	private $lang = null;

	public function setUp() {
		$this->lang = new HolQaH\language;
	}

	public function tearDown() {
		$this->lang = null;
	}

	public function testInstanceOf() {
		$this->assertInstanceOf('HolQaH\language',$this->lang);
	}

	public function testInvalidArgumentIsProperlyThrown() {
		$this->lang->phrase('nonExistentPhrase');
	}

}

?>