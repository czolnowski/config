<?php
namespace Mindweb\Config;

abstract class Configuration
{
    /**
     * @var array
     */
    protected $entries;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var bool
     */
    private $initialized = false;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        $this->init();

        $keyPath = explode('.', $key);
        $entries = &$this->entries;

        while ($index = array_shift($keyPath)) {
            if (!isset($entries[$index])) {
                throw new Exception\InvalidConfigEntryException($key, $this->path);
            }

            $entries = &$entries[$index];
        }

        return $entries;
    }

    /**
     * @return bool
     */
    final protected function isInitialized()
    {
        return $this->initialized;
    }

    abstract protected function init();
}