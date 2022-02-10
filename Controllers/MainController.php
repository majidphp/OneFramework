<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MainController extends App
{
    protected $view;
    protected $model;
    protected $log;
    protected $errorMsg;

    public function __construct()
    {
        $this->errorMsg = ErrorMsgs();
        $log = new Logger(LOG_NAME);
        $log->pushHandler(new StreamHandler(LOG_FILE, Logger::DEBUG));
        $this->log = $log;
        $this->view = $this->load('libs', 'smarty');
    }

    protected function redirect($address)
    {
        die(header('location:'.$address));
    }

    protected function checkRequireData($req, $sent)
    {
        foreach ($req as $item) {
            if (!array_key_exists($item, $sent) || @$sent[$item] === '') {
                return false;
            }
        }
        return true;
    }

    private function logInit($logName)
    {
        $this->logs = new Logger($logName);
        $this->logs->pushHandler(new StreamHandler(LOG_FILE, Logger::DEBUG));
    }
}
