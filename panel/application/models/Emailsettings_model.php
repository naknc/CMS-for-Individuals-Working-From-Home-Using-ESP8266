<?php

class Emailsettings_model extends VS_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->tableName = "email_settings";

    }

}
