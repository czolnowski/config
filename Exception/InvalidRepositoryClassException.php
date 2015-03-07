<?php
namespace Mindweb\Config\Exception;

use RuntimeException;

class InvalidRepositoryClassException extends RuntimeException
{
    public function __construct($repository)
    {
        parent::__construct('Invalid repository class for ' . $repository);
    }
} 