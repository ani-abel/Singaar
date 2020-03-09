<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/19/2019
 * Time: 11:06 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get the form fields here
    $email = (!empty($_POST["email"]) ? $_POST["email"] : die(
        output_err_message("Email is required")
    ));

    $password = (!empty($_POST["password"]) ? $_POST["password"] : die(
        output_err_message("Password is required")
    ));

    $username = (!empty($_POST["username"]) ? $_POST["username"] : die(
    output_err_message("Username is required")
    ));

    $musical_style = (!$_POST["musical_style"]==null ? implode(",", $_POST["musical_style"]) : die(
        output_err_message("Musical style is required")
    ));

    if( isset($musical_style, $email, $username, $password) ){
        $profile_image = $_FILES["profile_image"];
        Artists::editProfile($username, $email, $password, $musical_style, $profile_image);
    }
}