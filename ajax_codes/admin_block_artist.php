<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/12/2019
 * Time: 3:19 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = (!empty($_POST["user_id"]) ? (int)$_POST["user_id"] :
        die(
            output_err_message("Refresh page")
        ));

    if(isset($user_id))
        Admin::blockUser($user_id);
}