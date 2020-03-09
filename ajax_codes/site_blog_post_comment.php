<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/28/2019
 * Time: 7:40 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    //get form fields here
    $comment_by = (!empty($_POST['comment_by']) ? sanitizeLowercase($_POST['comment_by']) :
    die(
        output_err_message("Name field is required")
    ));

    $comment = (!empty($_POST['comment_body']) ? sanitizeLowercase($_POST['comment_body']) :
        die(
        output_err_message("Comment field is required")
        ));

    $comment_image = $_FILES['comment_image'];
    $post_id = (int)$_POST['post_id'];

    if( isset($comment_by, $comment, $post_id) ){
        BlogPosts::makeComment($post_id, $comment, $comment_by, $comment_image);
    }
}