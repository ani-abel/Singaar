<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/29/2019
 * Time: 9:23 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $todo = $_POST['todo'];

    if( !empty($todo) ){
        addToDo($todo);
    }
}