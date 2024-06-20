<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $uemail = $_SESSION["u"]["email"];

    $array;

    $orderID = uniqid();

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
    $pr = $productrs->fetch_assoc();

    $locrs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `location` ON `user_has_address`.`location_id`=`location`.`id`
     WHERE `user_email`='".$uemail."'");

    $ncr = $locrs->num_rows;

    if($ncr == 1){
        $cr = $locrs->fetch_assoc();
    
        $districtid = $cr["district_id"];
    
        $delivery = "0";
    
        if($districtid=="1"){
            $delivery = $pr["delivery_fee_colombo"];
        }else{
            $delivery = $pr["delivery_fee_other"];
        }
    
        $item = $pr["title"];
        $amount = $pr["price"] * $qty + (int)$delivery;
    
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $cr["line1"].",".$cr["line2"];
        
        $cityrs = Database::search("SELECT * FROM `city` WHERE `id`='".$cr["city_id"]."'");
        $dcity = $cityrs->fetch_assoc();
        $city = $dcity["name"];

        // $districtrs = Database::search("SELECT * FROM `district` WHERE `id`='".$cr["district_id"]."'");
        // $ddistrict = $districtrs->fetch_assoc();
        // $district = $ddistrict["name"];

        // $districtrs = Database::search("SELECT * FROM `province` WHERE `id`='".$cr["district_id"]."'");
        // $ddistrict = $districtrs->fetch_assoc();
        // $district = $ddistrict["name"];

        $array["id"]=$orderID;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["email"] = $uemail;
        $array["mobile"] = $mobile;
        $array["address"] = $address;
        $array["city"] = $city;

        echo json_encode($array);

    }else{
        echo "2";
    }
    


}else{
    echo "1";
}





?>