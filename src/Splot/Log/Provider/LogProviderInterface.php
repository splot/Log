<?php
/**
 * An interface for creating Splot-compatible loggers.
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

interface FactoryInterface
{

    /**
     * Provides a logger with the given name.
     * 
     * @param string $name [optional] Name of the logger.
     * @return LoggerInterface
     */
    public function provide($name = null);

}