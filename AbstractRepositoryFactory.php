<?php
namespace Mindweb\Config;

use Mindweb\Db\Connection;

abstract class AbstractRepositoryFactory
{
    protected $repositories = array();

    /**
     * @return string
     */
    abstract protected function getNamespace();

    /**
     * @return array
     */
    abstract protected function getMapping();

    /**
     * @param Connection $dbConfig
     * @param string $repository
     * @return Repository
     */
    public function get(Connection $dbConfig, $repository)
    {
        $repositoryClassName = sprintf('Mindweb\\%s\\Repository\\', $this->getNamespace());

        switch ($dbConfig->getType()) {
            case 'mysql':
                $repositoryClassName .= 'Mysql';
                break;

            case 'mongodb':
                $repositoryClassName .= 'Mongo';
                break;
        }

        $mapping = $this->getMapping();
        if (!isset($mapping[$repository])) {
            throw new Exception\NotMappedRepositoryException($repository);
        }
        $repositoryClassName .= $mapping[$repository];
        $repositoryClassName .= 'Repository';

        if (!isset($this->repositories[$repositoryClassName])) {
            $this->repositories[$repositoryClassName] = new $repositoryClassName($dbConfig->getHandler());
        }

        if (!$this->repositories[$repositoryClassName] instanceof Repository) {
            throw new Exception\InvalidRepositoryClassException($repository);
        }

        return $this->repositories[$repositoryClassName];
    }
}