<?php

$admin = false;
session_start();
if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
    echo "<script>location.href='default.php';</script>";
}
else {
    $_SESSION["admin"] = false;
    echo "<script>location.href='login.php';</script>";
}