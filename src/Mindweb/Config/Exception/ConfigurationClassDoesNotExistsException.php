<?php
namespace Mindweb\Config\Exception;

use RuntimeException;

class ConfigurationClassDoesNotExistsException extends RuntimeException
{
    public function __construct($configurationClassName)
    {
        parent::__construct('Configuration class doesn\'t exists: ' . $configurationClassName);
    }
} 