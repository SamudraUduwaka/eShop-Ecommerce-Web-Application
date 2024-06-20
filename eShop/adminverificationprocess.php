<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email = $_POST["e"];

    if(empty($email)){
        echo "Please enter your email address";
    }else{
        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
        $an = $adminrs->num_rows;

        if($an == 1){

            $code = uniqid();
            Database::iud("UPDATE `admin` SET `verification` = '".$code."' WHERE `email`='".$email."'");

            $mail = new PHPMailer; 
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true; 
$mail->Username = 'institutework678@gmail.com'; 
$mail->Password = 'Samu2021#';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('institutework678@gmail.com', 'eShop'); 
$mail->addReplyTo('institutework678@gmail.com', 'eShop'); 
$mail->addAddress($email); 
$mail->isHTML(true); 
$mail->Subject = 'eShop Admin verification code'; 
$bodyContent = '<h1 style="color:red;">Your Verification Code : '.$code.'</h1>'; 
$mail->Body    = $bodyContent; 

if(!$mail->send()) { 
    echo 'Verification code sending failed'; 
} else { 
    echo 'Success'; 
} 

        }else{
            echo "You are not an admin";
        }
    }
}else{
    echo "Please enter your Email";
}
