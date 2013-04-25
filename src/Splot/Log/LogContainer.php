<?php
/**
 * Log container.
 * 
 * Can contain a lot of various logs that then can be merged as returned as one.
 * 
 * @package SplotLog
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2013, Michał Dudek
 * @license MIT
 */
namespace Splot\Log;

use MD\Foundation\Exceptions\NotUniqueException;

use Splot\Log\Logger;
use Splot\Log\ExportableLogInterface;

/**
 * @static
 */
class LogContainer
{

    /**
     * Are all the loggers enabled?
     * 
     * This state will be inherited by all loggers created with ::create() method - but only during creation time.
     * 
     * @var bool
     */
    private static $_enabled = true;

    /**
     * Log start time so that all other log entries can be relative to this.
     * 
     * @var float
     */
    private static $_startTime;

    /**
     * Logs store.
     * 
     * @var array
     */
    protected static $_logs = array();

    /**
     * Registers a log under the given name.
     * 
     * The log needs to implement ExportableLogInterface
     *
     * @param string $name Name under which to register this log.
     * @param ExportableLogInterface $log Log to be registered.
     * 
     * @throws \InvalidArgumentException When $name is empty or not string.
     * @throws NotUniqueException When there is already a log under the given name.
     */
    public static function register($name, ExportableLogInterface $log) {
        if (empty($name)) {
            throw new \InvalidArgumentException('LogContainer::register() requires 1st argument to be a non-empty string, "'. $name .'" given.');
        }

        if (isset(static::$_logs[$name])) {
            throw new NotUniqueException('Log name needs to be unique - "'. $name .'" is already registered in the LogContainer.');
        }

        static::$_logs[$name] = $log;
    }

    /**
     * Creates an instance of Logger.
     * 
     * @param string $name Name under which the logger should be registered.
     * @return Logger
     */
    public static function create($name) {
        $logger = new Logger();
        $logger->setEnabled(static::getEnabled());

        static::register($name, $logger);

        return $logger;
    }

    /*****************************************************
     * SETTERS AND GETTERS
     *****************************************************/
    /**
     * Sets the start time so that all other log entries could be relative to this time.
     * 
     * @param float $startTime Start time in seconds (and microseconds).
     */
    public static function setStartTime($startTime) {
        if (!static::$_startTime) {
            static::$_startTime = $startTime;
        }
    }

    /**
     * Sets the loggers to be enabled or disabled.
     * 
     * All loggers created with create() method will inherit this state (only during creation).
     * 
     * @param bool $enabled
     */
    public static function setEnabled($enabled) {
        static::$_enabled = $enabled;
    }

    /**
     * Checks if the logger is enabled.
     * 
     * @return bool
     */
    public static function getEnabled() {
        return static::$_enabled;
    }

    /**
     * Checks if the logger is enabled.
     * 
     * @return bool
     */
    public static function isEnabled() {
        return static::getEnabled();
    }

    /**
     * Returns all registered logs.
     * 
     * @return array
     */
    public static function getLogs() {
        return static::$_logs;
    }

    /**
     * Exports all logs to an array format.
     * 
     * @return array
     */
    public static function exportLogs() {
        $logs = array();
        foreach(static::$_logs as $name => $log) {
            $logs[$name] = ($log instanceof ExportableLogInterface) ? $log->getLog() : 'Non-exportable log.';
        }

        return $logs;
    }

    /**
     * Returns names of all registered logs.
     * 
     * @return array
     */
    public static function getLogNames() {
        return array_keys(static::$_logs);
    }

}