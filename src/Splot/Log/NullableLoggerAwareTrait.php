<?php
/**
 * Trait that takes care of setting a logger if it's optional.
 * 
 * @package SplotLog
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2013, Michał Dudek
 * @license MIT
 */
namespace Splot\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

trait NullableLoggerAwareTrait
{

    /**
     * The logger.
     * 
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Sets a logger and if no logger specified it sets the logger to be NullLogger.
     * 
     * @param LoggerInterface $logger [optional] The logger to be set.
     */
    public function setLogger(LoggerInterface $logger = null) {
        $this->logger = ($logger === null) ? new NullLogger() : $logger;
    }

}