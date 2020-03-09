<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/14/2019
 * Time: 4:14 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get the video-path from the modal-box form
    $video_id = (!empty($_POST["video_id_column"]) ? (int)$_POST["video_id_column"] : die(
        output_err_message("Refresh page")
    ));

    if( isset($video_id) )
        Admin::deleteVideo($video_id);
}