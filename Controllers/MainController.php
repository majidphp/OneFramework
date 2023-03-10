<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MainController extends App
{
    protected $data;
    protected $view;
    protected $model;
    protected $log;
    protected $cache;
    protected $params;

    public function __construct()
    {
        if (LOG === 1) {
            $log = new Logger(LOG_NAME);
            $log->pushHandler(new StreamHandler(LOG_FILE, Logger::DEBUG));
            $this->log = $log;
        }
        if (VIEW === 1) $this->view = $this->load('libs', 'smarty');
        if (CACHE === 1) $this->cache = $this->load('libs', 'redis');
    }

    public function setData($data, $params = false)
    {
        $this->data = $data;
        $this->params = $params;
    }

    protected function redirect($address)
    {
        die(header('location:'.$address));
    }

    protected function checkRequireData($req, $sent)
    {
        foreach ($req as $item) {
            if (!array_key_exists($item, $sent) || @$sent[$item] === '') {
                if (is_array($sent[$item])) {
                    continue;
                }
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

    protected function mailer($to, $subject, $body, $attachment = false)
    {
        $mail = $this->load('libs', 'mailer');
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = EMAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = EMAIL_PORT;
        //Recipients
        $mail->setFrom(EMAIL_FROM, 'Mailer');
        $mail->addAddress($to);
        //Attachments
        if ($attachment == true) {
            $mail->addAttachment('/var/tmp/file.tar.gz');
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
        }
        //Content
        $mail->isHTML(true);               
    }

    public function randomString($maxLength = 8)
    {
        return substr(
            str_shuffle(
                str_repeat(
                    $x= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    ceil($length/strlen($x))
                )
            ),
            1,
            $maxLength
        );
    }

}
