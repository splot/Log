<?php
/**
 * Logger class.
 * 
 * @package SplotLog
 * @author Michał Dudek <michal@michaldudek.pl>
 * 
 * @copyright Copyright (c) 2013, Michał Dudek
 * @license MIT
 */
namespace Splot\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

use Splot\Foundation\Debug\Timer;
use Splot\Foundation\Utils\StringUtils;

use Splot\Log\ExportableLogInterface;

class Logger implements LoggerInterface, ExportableLogInterface
{

    /**
     * Is the logger enabled or not?
     * 
     * @var bool
     */
    protected $_enabled = true;

    /**
     * List of all log messages.
     * 
     * @var array
     */
    protected $_log = array();

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array()) {
        if (!$this->isEnabled()) {
            return false;
        }

        $tags = array();
        if (isset($context['_tags'])) {
            $tags = is_array($context['_tags']) ? $context['_tags'] : explode(',', trim((string)$context['_tags']));
            unset($context['_tags']);
        }

        $timer = null;
        if (isset($context['_timer']) && $context['_timer'] instanceof Timer) {
            $timer = $context['_timer'];
            unset($context['_timer']);
        }

        $this->_log[] = array(
            'timestamp' => Timer::getMicroTime(),
            'level' => $level,
            'message' => StringUtils::parseVariables((string)$message, $context),
            'context' => $context,
            'tags' => $tags,
            'timer' => $timer
        );
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     */
    public function emergency($message, array $context = array()) {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     */
    public function alert($message, array $context = array()) {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     */
    public function critical($message, array $context = array()) {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     */
    public function error($message, array $context = array()) {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     */
    public function warning($message, array $context = array()) {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     */
    public function notice($message, array $context = array()) {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     */
    public function info($message, array $context = array()) {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     */
    public function debug($message, array $context = array()) {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /*****************************************************
     * SETTERS AND GETTERS
     *****************************************************/
    /**
     * Sets the logger to be enabled or disabled.
     * 
     * @param bool $enabled
     */
    public function setEnabled($enabled) {
        $this->_enabled = $enabled;
    }

    /**
     * Checks if the logger is enabled.
     * 
     * @return bool
     */
    public function getEnabled() {
        return $this->_enabled;
    }

    /**
     * Checks if the logger is enabled.
     * 
     * @return bool
     */
    public function isEnabled() {
        return $this->getEnabled();
    }
    
} 