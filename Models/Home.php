<?php
class HomeModel extends MainModel
{
    private $table = 'users';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function selectById($id)
    {
        return $this->get(['key'=> 'id', 'value'=> $id]);
    }

}
