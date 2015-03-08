<?php
namespace Mindweb\Config\Exception;


use RuntimeException;

class InvalidConfigEntryException extends RuntimeException
{
    public function __construct($key, $configurationFilePath)
    {
        parent::__construct(sprintf(
            'Invalid config entry: %s. Please add this to configuration path. [%s]',
            $key, $configurationFilePath
        ));
    }
} 