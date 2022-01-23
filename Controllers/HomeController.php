<?php
class Home extends MainController
{
    public function index()
    {
        $user = $this->load('model', 'Home')->selectById(1);
        $this->view->assign('user', $user);
        $this->view->display('home.tpl');
    }
}