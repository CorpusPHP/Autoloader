<?php

namespace Corpus\Autoloader;

/**
 * Implementation of a PSR-4 Autoloader
 *
 * <code>
 * spl_autoload_register( new Psr4('My\\Prefix', '/vendor/path/blah') );
 * </code>
 *
 * @package Corpus\Autoloader
 */
class Psr4 {

	/**
	 * @var string
	 */
	protected $namespace;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param string $root_namespace Namespace prefix
	 * @param string $path Root path
	 */
	public function __construct( $root_namespace, $path ) {
		$this->namespace = $this->trimSlashes($root_namespace);
		$this->path      = rtrim($path, DIRECTORY_SEPARATOR);
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
		$class    = $this->trimSlashes($class);
		$ns_count = count(explode('\\', $this->namespace));

		if( $this->isOfNamespace($class) ) {
			$class_parts = explode('\\', $class);
			$class_parts = array_slice($class_parts, $ns_count);

			$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

			if( file_exists($filename) ) {
				require($filename);
			}

			return $filename;
		}

		return false;
	}

	/**
	 * @param $class_name
	 * @return bool
	 */
	protected function isOfNamespace( $class_name ) {
		return stripos($class_name, $this->namespace . '\\') === 0;
	}

}