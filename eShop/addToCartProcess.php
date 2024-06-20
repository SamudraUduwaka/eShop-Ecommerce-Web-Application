<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){
    
    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    if($qty==0){

        echo "please add a quantity";

    }else if(empty($qty)){

        echo "Qty can't be empty";

    }else if($qty<0){

        echo "Quantity can't be a negative value";

    }else{

        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$umail."' AND `product_id`='".$id."'");
        $cn = $cartrs->num_rows;
    
        if($cn==1){

            echo "This product is already exists in your Cart";

        }else{

            $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
            $pr = $productrs->fetch_assoc();

            if($pr["qty"] >= $qty){

                Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES('".$id."','".$umail."','".$qty."')");
                echo "success";

            }else{

                echo "Please enter a valid quantity below ".$pr['qty']."";

            }
            
        }
    }

    

}else{
    echo "Login first";
}


