<?php

class Settings_model extends VS_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "settings";

    }
}
