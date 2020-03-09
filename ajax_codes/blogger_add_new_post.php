<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/25/2019
 * Time: 11:26 PM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    //get the form fields here
    $post_title = (!(empty($_POST['post_title'])) ? sanitizeLowercase($_POST['post_title']) :
    die(
        output_err_message("Post title is a required field")
    ) );

    $post_title = (strlen($post_title) < 499 ? $post_title : die(
        output_err_message("Post title is too long")
    ));

    $post_body = ((!empty($_POST['body'])) ? $_POST['body'] :
    die(
        output_err_message("Post body is a required field")
    ));

    $post_category = (!(empty($_POST['post_category'])) ? (int)$_POST['post_category']:
    die(
        output_err_message("Select a category for your post")
    ));

    if( isset($post_title, $post_body, $post_category) ){
        //get the post image field here

        $post_image = $_FILES['post_image'];
        if($post_image == null || empty($post_image["name"]) || empty($post_image["type"]))
            BlogWriter::addBlogPost($post_title,$post_category,$post_body);
        else
            BlogWriter::addBlogPost($post_title, $post_category, $post_body, $post_image);
    }
}