<?php

// --- Includes the main language file.
require_once dirname(__FILE__).'/../src/HolQaH/lang/class.language.php';

// --- Test class.
class languageTest extends PHPUnit_Framework_TestCase {

	private $lang = null;

	public function setUp() {
		vfsStream::setup('someDir');
		$this->driver = new VGF_Storage_Driver_Filesystem();
		$this->driver->rootDir = vfsStream::url('someDir');
		$this->lang = new HolQaH\language;
	}

	public function tearDown() {
		$this->driver = null;
		$this->lang = null;
	}


	// ====================================================================================
	// The actual tests.

	public function testInstanceOf() {
		$this->assertInstanceOf('HolQaH\language', $this->lang);
	}

	// public function testSettings() {
		// $this->assertObjectHasAttribute('phrase', $this->lang);
	// }

}

?>