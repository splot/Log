<?php
/**
 * A provider class that creates loggers.
 * 
 * This can be used as a service to easily create loggers.
 * 
 * @package SplotLog
 * @subpackage Provider
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2013, Michał Dudek
 * @license MIT
 */
namespace Splot\Log\Provider;

use Psr\Log\LoggerInterface;

use Splot\Log\Provider\LogProviderInterface;
use Splot\Log\LogContainer;

class LogProvider implements LogProviderInterface
{

    /**
     * Creates a logger with the given name.
     * 
     * @param string $name [optional] Name of the logger.
     * @return LoggerInterface
     */
    public function provide($name = 'Log') {
        return LogContainer::create($name);
    }

}