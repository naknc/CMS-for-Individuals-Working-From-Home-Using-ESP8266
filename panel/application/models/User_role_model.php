<?php

class User_role_model extends VS_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "user_roles";

    }
}
