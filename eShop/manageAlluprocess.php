<?php

session_start();

if(isset($_SESSION["k"])){
    $u = $_SESSION["k"];

    session_destroy();
    echo "success";
}


?>