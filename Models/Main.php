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

    public function get($object, $where)
    {
        return $this->db->get($object, '*', [$where['key']=> $where['value']]);
    }

    public function count()
    {
        return $this->db->count($this->tableName);
    }

}