<?php
/**
 * An interface for creating Splot-compatible loggers.
 * 
 * This can be used as a service to easily create loggers.
 * 
 * @package SplotLog
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2013, Michał Dudek
 * @license MIT
 */
namespace Splot\Log;

use Psr\Log\LoggerInterface;

interface FactoryInterface
{

    /**
     * Creates a logger with the given name.
     * 
     * @param string $name [optional] Name of the logger.
     * @return LoggerInterface
     */
    public function create($name = null);

}