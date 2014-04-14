<?php

namespace Corpus\Test\Autoloader;

use Corpus\Autoloader\Psr0;

class Psr0Test extends \PHPUnit_Framework_TestCase {
	
	private $loader;

	public function setUp() {
		$this->loader = new Psr0('/vendor/foo.bar/src');
	}

	public function testExistingFile() {
		$loader = $this->loader;

		$actual = $loader('Foo\Bar\ClassName');
		$expect = '/vendor/foo.bar/src/Foo/Bar/ClassName.php';
		$this->assertSame($expect, $actual);
	}

	public function testPathSlashConfusion() {
		$loader = new Psr0('/vendor/foo.bar/src/');

		$actual = $loader('Foo\Bar\ClassName');
		$expect = '/vendor/foo.bar/src/Foo/Bar/ClassName.php';
		$this->assertSame($expect, $actual);
	}

}
 