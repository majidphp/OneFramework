<?php
class MainModel extends App
{
    protected $db;
    protected $logs;
    
    public function __construct()
    {
        $this->db = $this->load('libs', 'db');
    }

}