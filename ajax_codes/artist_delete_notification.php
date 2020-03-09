<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 3/4/2019
 * Time: 1:57 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get notification-id from ajax request
    $n_id = $_POST["n_id"];

    if( isset($_POST["n_id"]) )
        if( Artists::deleteNotification($n_id) )
            die(
                output_success_message("Deleted")
            );
}