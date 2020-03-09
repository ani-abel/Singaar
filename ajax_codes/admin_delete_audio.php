<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/14/2019
 * Time: 4:14 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get the audio-path from the modal-box form
    //get the video-path from the modal-box form
    $song_id = (!empty($_POST["audio_file_id"]) ? (int)$_POST["audio_file_id"] : die(
    output_err_message("Refresh page")
    ));

    if( isset($song_id) )
        Admin::deleteAudio($song_id);
}