<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/14/2019
 * Time: 12:38 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    //get the user input fields
    $artist_name = (!empty($_POST['artist_name']) ? sanitizeLowercase($_POST['artist_name']) :
        die(output_err_message("Artist name is required"))
    );

    $interview_month = (!empty($_POST['interview_month']) ? sanitizeLowercase($_POST['interview_month']) :
        die(output_err_message("Month is required"))
    );

    $introHypeMsg = (!empty($_POST['body']) ? sanitize($_POST['body']) :
        die(output_err_message("Intro text is required"))
    );

    $interview_video = ($_FILES['interview_video'] != null ? $_FILES['interview_video'] :
        die(output_err_message("Video selection was unsuccessful"))
    );

    if(isset($artist_name, $interview_month, $introHypeMsg))
        BlogWriter::addArtistInterview($interview_video, $artist_name, $interview_month, $introHypeMsg);
}