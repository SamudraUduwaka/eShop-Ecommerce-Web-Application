<?php

session_start();

if(isset($_SESSION["l"])){
    $u = $_SESSION["l"];

    session_destroy();
    echo "success";
}

?>