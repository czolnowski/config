<?php
namespace Mindweb\Config;

use JMS\Serializer;

class Configuration
{
    /**
     * @var array
     */
    protected $entries;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $format;

    /**
     * @var bool
     */
    private $initialied = false;

    /**
     * @param string $fileName
     * @param string $format
     */
    public function __construct($fileName, $format)
    {
        $this->fileName = $fileName;
        $this->format = $format;
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
                throw new Exception\InvalidConfigEntryException($key, $this->fileName);
            }

            $entries = &$entries[$index];
        }

        return $entries;
    }

    private function init()
    {
        if ($this->initialied) {
            return;
        }

        $serializer = Serializer\SerializerBuilder::create()->build();

        $this->entries = $serializer->deserialize(
            file_get_contents($this->fileName),
            'array',
            $this->format
        );

        $this->initialied = true;
    }
}