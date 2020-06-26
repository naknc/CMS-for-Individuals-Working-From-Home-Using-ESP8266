<?php

class Image_model extends VS_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "images";

    }

    public function delete_folder($where = array()){
        
        return $this->db->where($where)->delete($this->tableName);
        
    }
}
