<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/24/2019
 * Time: 12:49 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get form fields here
    $video_file = (!empty($_FILES["v_file"]["name"]) ? $_FILES["v_file"] : die(
        output_err_message("A video file is required")
    ));

    $video_desc = (!empty($_POST["v_desc"]) ? sanitizeLowercase($_POST["v_desc"]) : die(
        output_err_message("Video description is required")
    ));

    $video_title = (!empty($_POST["v_title"]) ? sanitizeLowercase($_POST["v_title"]) : die(
        output_err_message("Video title is required")
    ));

    if( isset($video_desc, $video_title, $video_file) )
        Artists::uploadVideoDetailsToSingaar($video_title, $video_desc, $video_file);
}