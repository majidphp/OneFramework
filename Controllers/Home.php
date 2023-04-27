<?php
class Home extends MainController
{
    public function index()
    {
        echo "Welcome to OneFramework";
        // $user = $this->load('model', 'Home')->selectById(1);
        // $this->view->assign('user', $user);
        // $this->view->assign('userData', $this->data);
        // $this->view->display('home.tpl');
        // // test redis cache
        // $this->cache->set('name', 'Te4st');
        // echo $this->cache->get('name');
    }
}