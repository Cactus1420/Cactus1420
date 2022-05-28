<?php


class App
{

    public static function init() //odchytí chybu kdy aplikace nezná třídu
    {
        spl_autoload_register([__CLASS__, "load"]);
    }

    public static function load($className) //načte onu třídu ze složky model
    {
        require_once "model/" . $className . ".php";
    }
}