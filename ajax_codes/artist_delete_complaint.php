<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/17/2019
 * Time: 7:40 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get the message id_ from ajax here
    $complaint_id = (!empty($_POST["complaint_id"]) ? (int)$_POST["complaint_id"] : die(
        output_err_message("Refresh page")
    ));

    if( isset($complaint_id) )
        Artists::deleteAComplaint($complaint_id);
}