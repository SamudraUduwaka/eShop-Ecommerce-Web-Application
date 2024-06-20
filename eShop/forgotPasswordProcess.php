<?php

require "connection.php";
require 'Exception.php'; 
require 'PHPMailer.php'; 
require 'SMTP.php'; 

use PHPMailer\PHPMailer\PHPMailer; 


if(isset($_GET["e"])){

    $e = $_GET["e"];

    if(empty($e)){

        echo "Please enter your email address";

    }else{

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."'");

        if($rs->num_rows == 1){

            $code = uniqid();

            Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$e."'");

 
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true; 
$mail->Username = 'institutework456@gmail.com'; 
$mail->Password = 'Samu2021#';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('institutework456@gmail.com', 'eShop'); 
$mail->addReplyTo('institutework456@gmail.com', 'eShop'); 
$mail->addAddress($e); 
$mail->isHTML(true); 
$mail->Subject = 'eShop Forgot password verification code'; 
$bodyContent = '<h1 style="color:red;">Your Verification Code : '.$code.'</h1>'; 
$mail->Body    = $bodyContent; 

if(!$mail->send()) { 
    echo 'Verification code sending failed'; 
} else { 
    echo 'Success'; 
} 

        }else{

            echo "Email address not found";

        }

    }

}else{

    echo "Please enter your email address";

}

?>