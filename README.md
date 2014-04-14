Autoloader
==========

[![Latest Stable Version](https://poser.pugx.org/corpus/autoloader/v/stable.png)](https://packagist.org/packages/corpus/autoloader)
[![License](https://poser.pugx.org/corpus/autoloader/license.png)](https://packagist.org/packages/corpus/autoloader)
[![Build Status](https://travis-ci.org/CorpusPHP/Autoloader.svg?branch=master)](https://travis-ci.org/CorpusPHP/Autoloader)

Simple PSR-0 and PSR-4 Style Autoloaders.


## Notes

The PSR-0 Autoloader does not include the Zend style underscore to / translation.

## Installing

Autoloader is available through Packagist via Composer

```json
{
    "require": {
        "corpus/autoloader": "1.*"
    }
}
```

## Usage

These are *simple* autoloaders, that operate on the SPL autoloader stack order. You use one instance *per* directory or namespace.

```php
<?php

use Corpus\Autoloader\Psr0;
use Corpus\Autoloader\Psr4;

// PSR-0 Autoloader
spl_autoload_register( new Psr0('/vendor/path/blah') );

// PSR-4 Autoloader
spl_autoload_register( new Psr4('My\\Prefix', '/vendor/path/blah') );

```