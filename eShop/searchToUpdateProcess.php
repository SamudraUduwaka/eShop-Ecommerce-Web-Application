<?php

require "connection.php";

$array;

if(isset($_GET["id"])){
    $id = $_GET["id"];

    if(empty($id)){
        echo "Please enter the product id";
    }else{

        $prs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
        $n = $prs->num_rows;

        if($n == 1){
            $r = $prs->fetch_assoc();

            $array['id'] = $r["id"];
            $array['title'] = $r["title"];
            $array['qty'] = $r["qty"];

            $crs = Database::search("SELECT * FROM `category` WHERE `id`='".$r["category_id"]."'");
            if($crs->num_rows == 1){
                $cr = $crs->fetch_assoc();
                $array["category"] = $cr["name"]; 
            } 

            $mhbrs = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$r["model_has_brand_id"]."'");
            if($mhbrs->num_rows == 1){
                $mhb = $mhbrs->fetch_assoc();

                $brs = Database::search("SELECT * FROM `brand` WHERE `id`='".$mhb["brand_id"]."'");
            if($brs->num_rows == 1){
                $br = $brs->fetch_assoc();
                $array["brand"] = $br["name"]; 
            } 

            $mrs = Database::search("SELECT * FROM `model` WHERE `id`='".$mhb["model_id"]."'");
            if($mrs->num_rows == 1){
                $mr = $mrs->fetch_assoc();
                $array["model"] = $mr["name"]; 
            } 
            } 

            $conrs = Database::search("SELECT * FROM `condition` WHERE `id`='".$r["condition_id"]."'");
            if($conrs->num_rows == 1){
                $conr = $conrs->fetch_assoc();
                $array["condition"] = $conr["name"]; 
            } 

            
            $array['price'] = $r["price"];
            $array['dwc'] = $r["delivery_fee_colombo"];
            $array['doc'] = $r["delivery_fee_other"];
            $array['desc'] = $r["description"];

            echo json_encode($array);

        }else{
            echo "Invalid Product";
        }
    
    }
}

?>