<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MainController extends App
{
    protected $data;
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

    public function setData($data)
    {
        $this->data = $data;
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

    protected function suggestPassword($length)
    {
        $alphabet = '!@#$%^&*()_+=-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

}
