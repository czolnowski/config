<?php
namespace Mindweb\Config;

use Symfony\Component\Config\Loader\LoaderInterface;

class Configuration
{
    /**
     * @var array
     */
    protected $entries;

    /**
     * @var bool
     */
    private $initialized = false;

    /**
     * @var LoaderInterface
     */
    private $loaderInterface;

    /**
     * @var array
     */
    private $resources;

    /**
     * @param LoaderInterface $loaderInterface
     * @param array $resources
     */
    public function __construct(LoaderInterface $loaderInterface, array $resources)
    {
        $this->loaderInterface = $loaderInterface;
        $this->resources = $resources;
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
                throw new Exception\InvalidConfigEntryException($key);
            }

            $entries = &$entries[$index];
        }

        return $entries;
    }

    /**
     * Initialize configuration.
     */
    protected function init()
    {
        if ($this->initialized) {
            return;
        }

        $this->entries = $this->loaderInterface->load($this->resources);
        $this->initialized = true;
    }
}