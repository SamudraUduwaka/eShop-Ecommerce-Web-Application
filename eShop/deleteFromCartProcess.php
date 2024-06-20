<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];
    $cid = $_GET["id"];

    $cartrs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cid."'");
    
    $cf = $cartrs->fetch_assoc();
    $pid = $cf["product_id"];

    $recentrs = Database::search("SELECT * FROM `recents` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
    $rn = $recentrs->num_rows;

    if($rn==1){

        Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");
        echo "success";

    }else{

        Database::iud("INSERT INTO `recents` (`product_id`,`user_email`) VALUES('".$pid."','".$email."')");
        Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");
        echo "success";

    }

}

?>