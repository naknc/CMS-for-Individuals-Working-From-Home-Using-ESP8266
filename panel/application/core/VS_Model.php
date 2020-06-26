<?php

class VS_Model extends CI_Model{
    
    public $tableName = "";

    public function __construct(){
        
        parent::__construct();

    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /** Tüm Kayıtları bana getirecek olan metot.. */
    public function get_all($where = array(), $order = "id ASC"){
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function add($data = array()){
        if(isAllowedWriteModule()){
            return $this->db->insert($this->tableName, $data);
        } else {
            return false;
        }
        
    }

    public function update($where = array(), $data = array()){
        if(isAllowedUpdateModule()){
            return $this->db->where($where)->update($this->tableName, $data);
        } else {
            return false;
        }
        
    }

    public function delete($where = array()){
        if(isAllowedDeleteModule()){
            return $this->db->where($where)->delete($this->tableName);
        } else {
            return false;
        }
        
    }

}