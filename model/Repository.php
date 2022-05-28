<?php

abstract class Repository
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}