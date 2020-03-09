<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/18/2019
 * Time: 10:52 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $msg_id = (!empty($_POST["msg_id"]) ? (int)$_POST["msg_id"] : die(
        output_err_message("Refresh page")
    ));

    $user_id = (!empty($_POST["msg_from"]) ? (int)$_POST["msg_from"] : die(
    output_err_message("Refresh page")
    ));

    $msg = (!empty($_POST["reply_msg"]) ? $_POST["reply_msg"] : die(
        output_err_message("Refresh page")
    ));

    if( isset($msg_id, $msg) ){
        $intro_text = createRandomMessageSalutation($user_id);
        $message_intro = "<h6 class='salutation text-capitalize blue-text text-darken-2'>{$intro_text}</h6>";
        //concat the final message to be sent to the user here
        $message = "{$message_intro}<p>{$msg}</p>";

        Admin::reply_c_c_messages($msg_id, $message);
    }
}