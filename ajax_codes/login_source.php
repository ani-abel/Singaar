<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/11/2019
 * Time: 12:22 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    //get form fields
    $username = (!empty($_POST['username']) ? sanitizeLowercase($_POST['username']) :
        die(output_err_message("Username is required"))
    );

    $password = (!empty($_POST['password']) ? $_POST['password'] :
        die(output_err_message("Password is required"))
    );

    $isUserRemembered = (isset($_POST['remember_me']) ? true : false);

    Login::logUser($username, $password, $isUserRemembered);
}