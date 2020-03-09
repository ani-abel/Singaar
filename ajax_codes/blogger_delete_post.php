<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/27/2019
 * Time: 4:22 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $post_id = $_POST['del_post_id'];
    if(isset($post_id)){
        BlogWriter::deleteAPost($post_id);
    }
}