<?php

namespace SystemdLogHandler\src;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Class SystemdLogHandler
 * @package SystemdLogHandler\src
 */
class SystemdLogHandler extends AbstractProcessingHandler
{
    const EMERGENCY = 0;
    const ALERT = 1;
    const CRITICAL = 2;
    const ERROR = 3;
    const WARNING = 4;
    const NOTICE = 5;
    const INFO = 6;
    const DEBUG = 7;

    protected static $levels = array(
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    );

    /** @var string */
    protected $appname;

    protected function addRecord($severity, $message, array $context) {
        print_r("$message");
        sd_journal_send('MESSAGE=' . sprintf($message, $context),'PRIORITY=' . $severity, 'SYSLOG_IDENTIFIER=Linker');
        return true;
    }
}
