<?php
/**
 * A factory class that creates loggers.
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

use Splot\Log\FactoryInterface;
use Splot\Log\LogContainer;

class Factory implements FactoryInterface
{

    /**
     * Creates a logger with the given name.
     * 
     * @param string $name [optional] Name of the logger.
     * @return LoggerInterface
     */
    public function create($name = null) {
        $name = $name ?: 'Log';
        return LogContainer::create($name);
    }

}