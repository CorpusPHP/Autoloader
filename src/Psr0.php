<?php

namespace Corpus\Autoloader;

/**
 * Implementation of a PSR-0 Autoloader ignoring the Zend _ nonsense.
 *
 * <code>
 * spl_autoload_register( new Psr0('/vendor/path/blah') );
 * </code>
 *
 * @package Corpus\Autoloader
 */
class Psr0 {

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param string $path Root path
	 */
	public function __construct( $path ) {
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
	}

	/**
	 * @param string $path
	 * @return string
	 */
	protected final function trimSlashes( $path ) {
		return trim($path, ' /\\');
	}

	/**
	 * @param $class
	 * @return bool|string
	 */
	public function __invoke( $class ) {
		$class       = $this->trimSlashes($class);
		$class_parts = explode('\\', $class);

		$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

		if( file_exists($filename) ) {
			require($filename);
		}

		return $filename;
	}


} 