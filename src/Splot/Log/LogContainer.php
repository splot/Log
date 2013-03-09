<?php
namespace Splot\Log;

use Splot\Foundation\Exceptions\NotUniqueException;

use Splot\Log\Logger;
use Splot\Log\ExportableLogInterface;

class LogContainer
{

    protected static $_loggers = array();

    public static function register($name, ExportableLogInterface $log) {
        if (empty($name)) {
            throw new \InvalidArgumentException('LogContainer::register() requires 1st argument to be a non-empty string, "'. $name .'" given.');
        }

        if (isset(static::$_loggers[$name])) {
            throw new NotUniqueException('Logger name needs to be unique - "'. $name .'" is already registered in the LogContainer.');
        }

        static::$_loggers[$name] = $log;
    }

    public static function create($name) {
        $logger = new Logger();
        static::register($name, $logger);

        return $logger;
    }

}