<?php

namespace Corpus\Test\Autoloader;

use Corpus\Autoloader\Psr4;

class Psr4Test extends \PHPUnit_Framework_TestCase {

	private $loader;

	public function setUp() {
		$this->loader = new Psr4('Foo\\Bar', '/vendor/foo.bar/src');
	}

	public function testExistingFile() {
		$loader = $this->loader;

		$actual = $loader('Foo\Bar\ClassName');
		$expect = '/vendor/foo.bar/src/ClassName.php';
		$this->assertSame($expect, $actual);
	}

	public function testMissingFile() {
		$loader = $this->loader;

		$actual = $loader('No_Vendor\No_Package\NoClass');
		$this->assertFalse($actual);
	}

	public function testNamespaceSlashConfusion() {
		$loader = $this->loader;

		$actual = $loader('Foo\BarClassName');
		$this->assertFalse($actual);
	}

	public function testPathSlashConfusion() {
		$loader = new Psr4('Foo\\Bar', '/vendor/foo.bar/src/');

		$actual = $loader('Foo\Bar\ClassName');
		$expect = '/vendor/foo.bar/src/ClassName.php';
		$this->assertSame($expect, $actual);
	}

}
 