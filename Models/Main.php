<?php
class MainModel extends App
{
    protected $db;
    protected $logs;
    private $tableName;
    
    public function __construct($tableName)
    {
        $this->db = $this->load('syslibs', 'db');
        $this->tableName = $tableName;
    }

    public function get($where)
    {
        return $this->db->get($this->tableName, '*', [$where['key']=> $where['value']]);
    }

    public function count()
    {
        return $this->db->count($this->tableName);
    }

}