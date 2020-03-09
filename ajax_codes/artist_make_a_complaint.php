<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/17/2019
 * Time: 9:56 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $complaint_title = (!empty($_POST["complaint_title"]) ? sanitizeLowercase($_POST["complaint_title"]) : die(
        output_err_message("Title is required")
    ));

    $complaint_message = (!empty($_POST["complaint-message"]) ? sanitizeLowercase($_POST["complaint-message"]) : die(
        output_err_message("Message is required")
    ));

    if( isset($complaint_title, $complaint_message) )
        Artists::makeComplaintToSingaar($complaint_title, $complaint_message);
}