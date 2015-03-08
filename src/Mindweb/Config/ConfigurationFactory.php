<?php
namespace Mindweb\Config;

class ConfigurationFactory
{
    /**
     * @param string $vendor
     * @param string $namespace
     * @param string $path
     * @return Configuration
     */
    public static function factory($vendor, $namespace, $path)
    {
        $configurationClassName = sprintf('%s\\%s\\Configuration', $vendor, $namespace);

        if (!class_exists($configurationClassName)) {
            throw new Exception\ConfigurationClassDoesNotExistsException($configurationClassName);
        }

        $configuration = new $configurationClassName($path);
        if (!$configuration instanceof Configuration) {
            throw new Exception\ConfigurationClassDoesNotImplementConfigurationException($configurationClassName);
        }

        return $configuration;
    }
} 