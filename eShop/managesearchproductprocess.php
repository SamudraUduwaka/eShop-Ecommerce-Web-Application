<?php

session_start();

require "connection.php";

if(isset($_GET["s"])){
    $text = $_GET["s"];

    if(!empty($text)){
        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '".$text."'");
        $n = $productrs->num_rows;

        if($n == 1){
            $row = $productrs->fetch_assoc();

            $_SESSION["l"] = $row;
            echo "success";
        }else{
            echo "No any such product available.";
        }
        
    }else{
        echo "Please add an id to search";
    }
}



?>