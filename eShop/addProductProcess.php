<?php

require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = (int)$_POST["co"];
$colour = (int)$_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$desc = $_POST["desc"];

if(isset($_FILES["img"])){
    $imageFile = $_FILES["img"];
}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail = "institutework678@gmail.com";

if ($category=="Select Category"){
    echo "Please Select a Category.";
}else if($brand=="Select Brand"){
    echo "Please Select a Brand.";
}else if($model=="Select Model"){
    echo "Please Select a Model.";
}else if(empty($title)){
    echo "Give a title to your product.";
}else if(strlen($title)>100){
    echo "Title must not exceed 100 characters.";
}else if($qty=="0"|| $qty=="e"){
    echo "Please give the product quantity.";
}else if(!is_int($qty)){
    echo "Please add a valid quantity.";
}else if(empty($qty)){
    echo "Please add the quantity of your product.";
}else if($qty<0){
    echo "Product quantity can't be a negative value.";
}else if(empty($price)){
    echo "Please give the price to your product.";
}else if(!is_int($price)){
    echo "Please enter a valid price";
}else if(empty($dwc)){
    echo "Enter a delivery fee within Colombo";
}else if(!is_int($dwc)){
    echo "Please insert a valid price";
}else if(empty($doc)){
    echo "Enter a delivery fee outof Colombo";
}else if(!is_int($doc)){
    echo "Please insert a valid price";
}else if(empty($desc)){
    echo "Please add a description to your product";
}else{
    $modelHasBrand = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");

    if($modelHasBrand->num_rows == 0){
        echo "This Product doesn't exist";
    }else{

        $file_extension;

        if(isset($_FILES["img"])){
            $allowed_Image_Extention = array("image/jpg","image/png","image/jpeg","image/svg");

            $file_extension = $imageFile["type"];
        
                    if(!in_array($file_extension,$allowed_Image_Extention)){
                        echo "Please select a valid image.";
                    }else{

                        $f = $modelHasBrand->fetch_assoc();
                        $modelHasBrandId = $f["id"];

                        Database::iud("INSERT INTO `product` (`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) VALUES('".$category."','".$modelHasBrandId."','".$title."','".$colour."','".$price."','".$qty."','".$desc."','".$condition."','".$state."','".$useremail."','".$date."','".$dwc."','".$doc."')");

                        $lastId = Database::$connection->insert_id;
        
                        $newImageExtension;
        
                        if($file_extension="image/jpg"){
                            $newImageExtension = ".jpg";
                        }else if($file_extension="image/jpeg"){
                            $newImageExtension = ".jpeg";
                        }else if($file_extension="image/png"){
                            $newImageExtension = ".png";
                        }else if($file_extension="image/svg"){
                            $newImageExtension = ".svg";
                        }
        
                        $fileName = "resources//products//".uniqid().$newImageExtension;
                        move_uploaded_file($imageFile["tmp_name"],$fileName);
        
                        Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('".$fileName."','".$lastId."')");
        
                        echo "1";
                    }

        }else{
            echo "Please select an image";
        }
        
    
    }
    
}

?>
