<?php
class MainModel extends App
{
    protected $db;
    protected $logs;
    
    public function __construct()
    {
        $this->db = $this->load('libs', 'db');
    }

    public function get($object, $where)
    {
        return $this->db->get($object, '*', [$where['key']=> $where['value']]);
    }

}