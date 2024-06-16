<?php

require "connection.php";

session_start();

if(isset($_SESSION["u"])){
    $email = $_SESSION['u']['email'];
    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $city = $_POST["c"];

    if(isset($_FILES["i"])){
        $image = $_FILES["i"];
        $img = $_FILES["i"]["name"];
        $file_extension;

            $allowed_Image_Extention = array("image/jpg","image/png","image/jpeg","image/svg");

            $file_extension = $image["type"];
        
                    if(!in_array($file_extension,$allowed_Image_Extention)){
                        echo "Please select a valid image.";
                    }else{

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
        
                        $fileName = "resources//profile_images//".uniqid().$newImageExtension;
                        move_uploaded_file($image["tmp_name"],$fileName);

                        $checkavail = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$email."'");
                        if($checkavail->num_rows==1){
                            Database::iud("UPDATE `profile_image` SET `code`='".$fileName."'");
                        }else if($checkavail->num_rows==0){
                            Database::iud("INSERT INTO `profile_image`(`code`,`user_email`) VALUES ('".$fileName."','".$_SESSION["u"]["email"]."')");
                        }
        
                        echo "1";
    
                    }
    }

    if(empty($fname)){

        echo "Please enter your first name";

    }else if(strlen($fname) > 50){

        echo "First name must be less than 50 characters";

    }elseif(empty($lname)){

        echo "Please enter your last name";

    }else if(strlen($lname)>50){

        echo "Last name must be less than 50 characters";

    }elseif(empty($mobile)){

        echo "Please enter your mobile";

    }else if(strlen($mobile)!=10){

        echo "Please enter 10 digit mobile number";

    }else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){

        echo "Invalid mobile number";
    
    }elseif(empty($line1)){

        echo "Enter the address line 1";

    }elseif(empty($line2)){

        echo "Enter the address line 2";

    }elseif($city=="0"){

        echo "Please Select Your City";

    }else{

        Database::iud("UPDATE `user` SET `fname` = '".$fname."',`lname` = '".$lname."',`mobile` = '".$mobile."'
        WHERE `email`='".$_SESSION["u"]["email"]."'
        ");

        echo "User table updated";
        
        $addresses = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
        $naddress = $addresses->num_rows;

        if($naddress==1){

            $daddress = $addresses->fetch_assoc();
            $ulocation = Database::search("SELECT * FROM `location` WHERE `city_id`='".$city."'");
            $unrlocation = $ulocation->fetch_assoc();

            Database::iud("UPDATE `user_has_address` SET 
            `line1`='".$line1."',`line2`='".$line2."',`location_id`='".$unrlocation["id"]."' WHERE `id`='".$daddress["id"]."'
            ");

            echo "address updated";
        }else{

            $daddress = $addresses->fetch_assoc();
            $ulocations = Database::search("SELECT * FROM `location` WHERE `city_id`='".$city."'");
            $unrlocations = $ulocations->fetch_assoc();

            Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`location_id`) VALUES ('".$email."','".$line1."','".$line2."','".$unrlocations['id']."')");
            echo "new Address added";

        }

        $users = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        $uuuu = $users->fetch_assoc();
        $_SESSION["u"] = $uuuu;

    }
}

?>
