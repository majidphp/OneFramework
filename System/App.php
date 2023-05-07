<?php 
/**
 * System Main file
 */
class App 
{
    private $data = [];
    private $router = [];

    public function init()
    {
        Dotenv\Dotenv::createImmutable(PRIVATE_DIR, DOTENV)->safeLoad();
        $this->router = $this->load('syslib', 'router');
        $this->stdin();
        if (DEBUG) $this->load('syslib', 'error');
    }

    public function load($kind, $file)
    {
        switch ($kind) {
            case 'syslib':
                include_once SYSTEM_DIR.'Libraries.php';
                return Libraries::$file();
                break;
            case 'model':
                include_once MODELS_DIR.'Main.php';
                include_once MODELS_DIR.$file.'.php';
                $model = $file.'Model';
                return new $model;
                break;
            case 'controller':
                include_once CONTROLLERS.'Main.php';
                include_once CONTROLLERS.$file.'.php';
                return new $file;
                break;
            case 'usrlib':
                include_once USR_LIBRARY_DIR.$file.'/'.$file.'.php';
                return new $file;
                break;
        }

    }

    public function run()
    {
        if (isset($_SESSION['user']['acl'])) {
            $this->acl($this->$this->router['controller']);
        }
        $class = $this->load('controller', $this->router['controller']);
        $action = $this->router['action'];
        $class->setData($this->data, $this->router['params']);
        $class->$action();
    }

    public function format($format)
    {
        switch($format) {
            case 'json':
                header('Access-Control-Allow-Origin: *');
                header('Content-Type: application/json; charset=UTF-8');
                header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
                header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
                header('Content-Type: application/json');
                header('Access-Control-Expose-Headers: Content-Length, X-JSON');
            break;
            case 'html':
                header('Content-Type: text/html');
            break;
        }
    }

    public function response($res = null, $status = 200, $format = 'json')
    {
        http_response_code($status);
        $this->format($format);
        if ($res) {
            if ($format === 'json') {
                echo json_encode($res);
            }
        }
    }

    private function security($data)
    {
        $res = [];
        if(is_array ($data)) {
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    $i = 0;
                    foreach ($val as $k => $v) {
                        $res[$key][$k] = htmlspecialchars($v, double_encode: false);
                        $res[$key][$k] = trim($res[$key][$k]);
                        // $res = stripslashes($res);
                        $res[$key][$k] = strip_tags($res[$key][$k]);
                        $res[$key][$k] = filter_var($res[$key][$k], FILTER_SANITIZE_STRING);
                        $res[$key][$k] = filter_var($res[$key][$k],FILTER_SANITIZE_STRIPPED);
                        $res[$key][$k] = filter_var($res[$key][$k],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $i++;
                    }
                } else {
                    $res[$key] = htmlspecialchars($val, double_encode: false);
                    $res[$key] = trim($val);
                    // $res = stripslashes($res);
                    $res[$key] = strip_tags($val);
                    $res[$key] = filter_var($val, FILTER_SANITIZE_STRING);
                    $res[$key] = filter_var($val,FILTER_SANITIZE_STRIPPED);
                    $res[$key] = filter_var($val,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
            }
            return $res;
        }
        else {
            $res = htmlspecialchars($data, double_encode: false);
            $res = trim($res);
            // $res = stripslashes($res);
            $res = strip_tags($res);
            $res = filter_var($res, FILTER_SANITIZE_STRING);
            $res = filter_var($res,FILTER_SANITIZE_STRIPPED);
            $res = filter_var($res,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            return $res;
        }

    }

    public function __toString()
    {
        return "This is main class of framework";
    }

    private function stdin()
    {
        if ($_GET) $this->data['get'] = $this->security($_GET);
        if ($_POST) $this->data['post'] = $this->security($_POST);
        if (file_get_contents('php://input')) {
            $this->data['raw'] = $this->security(json_decode(file_get_contents('php://input'), true));
        }
    }

    protected function acl($controller)
    {
        if (!in_array($controller, $_SESSION['user']['acl'])) {
            return false;
        }
        return true;
    }

}
