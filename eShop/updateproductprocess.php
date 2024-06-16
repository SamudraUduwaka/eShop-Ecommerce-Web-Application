<?php

session_start();

require "connection.php";

$id = $_POST["id"];
$title = $_POST["t"];
$qty = $_POST["qty"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

if(isset($_FILES["img"])){
    $imageFile = $_FILES["img"];
}

if(empty($title)){
    echo "Give a title to update";
}else if(strlen($title)>100){
    echo "Title must not exceed 100 characters.";
}else if($qty=="0"|| $qty=="e"){
    echo "Please give the product quantity.";
}else if(empty($qty)){
    echo "quantity can't be an empty value";    
}else if($qty<0){
    echo "Product quantity can't be a negative value.";
}else if(empty($dwc)){
    echo "Enter a delivery fee within Colombo";
}else if(empty($doc)){
    echo "Enter a delivery fee outof Colombo";
}else if(empty($desc)){
    echo "Please add a description to your product";
}else{
    $file_extension;

        if(isset($_FILES["img"])){
            $allowed_Image_Extention = array("image/jpg","image/png","image/jpeg","image/svg");

            $file_extension = $imageFile["type"];
        
                    if(!in_array($file_extension,$allowed_Image_Extention)){
                        echo "Please select a valid image.";
                    }else{

                        Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',`description`='".$desc."',
                        `delivery_fee_colombo`='".$dwc."',`delivery_fee_other`='".$doc."' WHERE `id`='".$id."'");
        
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
        
                        Database::iud("UPDATE `images` SET `code`='".$fileName."' WHERE `product_id`='".$id."' ");

                        echo "Success";
        
                    }

        }else{
            echo "Please select an image";
        }
}

?>