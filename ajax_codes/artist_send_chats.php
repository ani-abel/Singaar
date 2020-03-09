<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/26/2019
 * Time: 10:20 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $msg_to = (!empty($_POST["msg_to"]) ? (int)$_POST["msg_to"] : die(
        output_err_message("Message not sent. Try again")
    ));

    $msg = (!empty($_POST["write_msg"]) ? sanitizeLowercase($_POST["write_msg"]) : die(
        output_err_message("Message not sent. Try again")
    ));

    if( isset($msg, $msg_to) )
        Artists::addChat($msg_to, $msg);
}