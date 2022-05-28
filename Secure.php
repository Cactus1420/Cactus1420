<?php
session_start();

require_once "App.php";
App::init();

session_regenerate_id();

if (!isset($_SESSION["user"]))
{
    header("Location: users/login.php");
}

