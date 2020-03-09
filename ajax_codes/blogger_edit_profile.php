<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/13/2019
 * Time: 10:45 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    //get the form fields from page
    $username = (!empty($_POST['new_username']) ? sanitizeLowercase($_POST['new_username']) :
        die(output_err_message("Username is required"))
    );

    $email = (!empty($_POST['new_email']) ? sanitizeLowercase($_POST['new_email']) :
        die(output_err_message("Email is required"))
    );

    $password = (!empty($_POST['new_password']) ? sanitizeLowercase($_POST['new_password']) :
        die(output_err_message("Password is required"))
    );

    if(isset($username, $password, $email)){
        BlogWriter::editProfile($username, $password,$email);
    }

}