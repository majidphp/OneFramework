<?php
class HomeModel extends MainModel
{
    public function selectById($id)
    {
        return $this->db->get('users', '*', ['id'=>$id]);
    }

}
