<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/7/2019
 * Time: 10:48 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST") {
    //get form fields here
    $username = (!empty($_POST['username']) ? sanitizeLowercase($_POST['username']) :
        die(output_err_message("Username is required"))
    );

    $email = (!empty($_POST['email']) ? sanitizeLowercase($_POST['email']) :
        die(output_err_message("Email is required"))
    );

    $password = (!empty($_POST['password']) ? sanitizeLowercase($_POST['password']) :
        die(output_err_message("Password is required"))
    );

    $activeSince = (!empty($_POST['active_since']) ? sanitizeLowercase($_POST['active_since']) :
        die(output_err_message("Active since is required"))
    );

    $genres = (!($_POST['musical_style'] == null) ? sanitizeLowercase(implode($_POST['musical_style'], ",")) :
        die(output_err_message("Musical style is required"))
    );

    $signUp = new SignUp($email, $username, $password, $genres, $activeSince);
    $signUp->addUser();
}