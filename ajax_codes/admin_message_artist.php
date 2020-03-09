<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/14/2019
 * Time: 11:04 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get form fields here
    $message_title = (!empty($_POST["message_title"]) ? $_POST["message_title"] : die(
        output_err_message("Message title is required")
    ));

    $message = (!empty($_POST["message_body"]) ? ucfirst($_POST["message_body"]) : die(
        output_err_message("Message is required")
    ));

    $user_id = (!empty($_POST["artist_id"]) ? $_POST["artist_id"] : die(
        output_err_message("Refresh page")
    ));

    $date_of_entry = time();

    if( isset($message_title, $message, $user_id) ){
        $intro_text = createRandomMessageSalutation($user_id);
        $message_intro = "<h6 class='salutation text-capitalize blue-text text-darken-2'>{$intro_text}</h6>";
        //concat the final message to be sent to the user here
        $message = "{$message_intro}<p>{$message}</p>";
        //run the insert query here
        Admin::messageArtists($user_id, $message_title, $message);
    }
}