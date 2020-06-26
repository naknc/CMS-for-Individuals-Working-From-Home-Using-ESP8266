<?php

class User_model extends VS_Model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->tableName = "users";

    }

    public function update_pass($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }
}
