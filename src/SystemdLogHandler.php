<?php

namespace SystemdLogHandler;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * Class SystemdLogHandler
 * @package SystemdLogHandler
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

    private $initialized = false;
    private $pdo;
    private $statement;

    public function __construct(PDO $pdo, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        print_r($record);
        sd_journal_send('MESSAGE=' . sprintf($message, $context),'PRIORITY=' . $severity, 'SYSLOG_IDENTIFIER=Linker');
    }
}

