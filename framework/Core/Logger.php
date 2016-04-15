<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-15
 */
namespace Framework\Core;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger {

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }

}