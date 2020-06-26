<?php

class Portfolio_model extends VS_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "portfolios";

    }
}
