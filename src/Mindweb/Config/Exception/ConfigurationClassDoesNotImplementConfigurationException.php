<?php
namespace Mindweb\Config\Exception;

use RuntimeException;

class ConfigurationClassDoesNotImplementConfigurationException extends RuntimeException
{
    public function __construct($configurationClassName)
    {
        parent::__construct('Configuration class doesn\'t implement Configuration class: ' . $configurationClassName);
    }
} 