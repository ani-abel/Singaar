<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/22/2019
 * Time: 4:46 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $isPublic = (isset($_POST["isPublic"]) ? 1 : 0);
    $profile_text = (!empty($_POST["profile_text"]) ? $_POST["profile_text"] : die(
        output_err_message("profile text is required")
    ));

    $twitter_handle = sanitizeLowercase($_POST["twitter_handle"]);
    $whatsapp_numbers = sanitizeLowercase($_POST["whatsapp"]);
    $instagram_numbers = sanitizeLowercase($_POST["instagram_handle"]);
    $fb_link = sanitizeLowercase($_POST["fb_page"]);

    if( isset($profile_text) )
        Artists::managePublicPage($isPublic, $profile_text, $fb_link, $twitter_handle, $instagram_numbers, $whatsapp_numbers);
}