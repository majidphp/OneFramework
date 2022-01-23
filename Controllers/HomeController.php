<?php
class Home extends MainController
{
    public function index($data)
    {
        $user = $this->load('model', 'Home')->selectById(1);
        $this->view->assign('user', $user);
        $this->view->assign('userData', $data);
        $this->view->display('home.tpl');
    }
}