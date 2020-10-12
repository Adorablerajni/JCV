<?php

function generateCaptcha(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $text = rand(10000,99999);
    $_SESSION["vercode"] = $text;

    $height = 22; //CAPTCHA image height
    $width = 60; //CAPTCHA image width

    $image_p = imagecreate($width, $height);
    $black = imagecolorallocate($image_p, 0, 0, 0);
    $white = imagecolorallocate($image_p, 255, 255, 255);
    $font_size = 12; 
    imagestring($image_p, $font_size, 5, 3, $text, $white);
    imagejpeg($image_p, null, 80);
}

generateCaptcha();

?>