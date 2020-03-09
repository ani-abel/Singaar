<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/17/2019
 * Time: 9:41 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $msg_id = (!empty($_POST["msg_id"]) ? (int)$_POST["msg_id"] : die(
        output_err_message("Refresh page")
    ));

    if( isset($msg_id) )
        Artists::deleteMessageFromSingaar($msg_id);
}