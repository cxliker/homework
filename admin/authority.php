<?php

$admin = false;
session_start();
if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
}
else {
    $_SESSION["admin"] = false;
    die("请先<a href='login.php'>登陆</a>");
}