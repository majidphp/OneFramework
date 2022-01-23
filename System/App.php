<?php
/**
 * Don't change anything in this file.
 */
class App 
{
    public function init($data = null)
    {
        Dotenv\Dotenv::createImmutable(PRIVATE_DIR, DOTENV)->safeLoad();
        $index = [];
        $index['router'] = $this->load('libs', 'router');
        if($data) {
            $data = $this->security($data);
        } else {
            $data = null;
        }
        $index['data'] = $data;
        return $index;
    }

    public function load($kind, $file)
    {
        switch ($kind) {
            case 'libs':
                include_once SYSTEM_DIR.'Libraries.php';
                return Libraries::$file();
                break;
            case 'model':
                include_once MODELS_DIR.'MainModel.php';
                new MainModel;
                include_once MODELS_DIR.$file.'Model.php';
                $model = $file.'Model';
                return new $model;
                break;
        }

    }

    public function run($controller, $action, $params=false, $data=false)
    {
        include_once CONTROLLERS.'MainController.php';
        include_once CONTROLLERS.$controller.'Controller.php';
        $controller = new $controller;
        $data['params'] = $params;
        $data['data'] = $data;
        return call_user_func_array(array($controller,$action),array($data));
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

    public function return($res = null, $status = 200, $format = 'json')
    {
        http_response_code($status);
        $this->format($format);
        if ($res) {
            if ($format === 'json') {
                echo json_encode($res);
            }
        }
    }

    public function get_gets($getItem = 'ALL')
    {
        if($getItem != 'ALL') { 
            return $this->gets[$getItem];
        } else {
            return $this->gets;
        }
    }

    private function security($data)
    {
        if(is_array ($data)) {
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    $i = 0;
                    foreach ($val as $k => $v) {
                        $res[$k] = htmlspecialchars($v, double_encode: false);
                        $res[$k] = trim($res[$k]);
                        // $res = stripslashes($res);
                        $res[$k] = strip_tags($res[$k]);
                        $res[$k] = filter_var($res[$k], FILTER_SANITIZE_STRING);
                        $res[$k] = filter_var($res[$k],FILTER_SANITIZE_STRIPPED);
                        $res[$k] = filter_var($res[$k],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

}
