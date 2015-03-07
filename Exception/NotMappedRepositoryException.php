<?php
namespace Mindweb\Config\Exception;

use RuntimeException;

class NotMappedRepositoryException extends RuntimeException
{
    public function __construct($repository)
    {
        parent::__construct('Not mapped repository: ' . $repository);
    }
} 