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

    public function security($data)
    {
        if (is_array($data)) {
            $res = [];
            array_walk_recursive($data, function($item, $key) use(&$res) {
                $filter = htmlspecialchars($item, double_encode: false);
                $filter = trim($filter);
                $filter = strip_tags($filter);
                $filter = filter_var($filter, FILTER_SANITIZE_STRING);
                $filter = filter_var($filter,FILTER_SANITIZE_STRIPPED);
                $filter = filter_var($filter,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $res[] = $filter;
            });
        } else {
            $res = '';
            $filter = htmlspecialchars($data, double_encode: false);
            $filter = trim($filter);
            $filter = strip_tags($filter);
            $filter = filter_var($filter, FILTER_SANITIZE_STRING);
            $filter = filter_var($filter,FILTER_SANITIZE_STRIPPED);
            $filter = filter_var($filter,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $res = $filter;
        }
        return $res;
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
