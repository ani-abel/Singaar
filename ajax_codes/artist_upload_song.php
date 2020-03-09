<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/24/2019
 * Time: 12:48 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get form fields here
    $audio_file = (!empty($_FILES["a_file"]["name"]) ? $_FILES["a_file"] : die(
        output_err_message("An audio file is required")
    ));

    $audio_desc = (!empty($_POST["a_desc"]) ? sanitizeLowercase($_POST["a_desc"]) : die(
        output_err_message("Song description is required")
    ));

    $audio_title = (!empty($_POST["a_title"]) ? sanitizeLowercase($_POST["a_title"]) : die(
    output_err_message("Song title is required")
    ));

    if( isset($audio_desc, $audio_title, $audio_file) )
        Artists::uploadAudioDetailsToSingaar($audio_title, $audio_desc, $audio_file);
}