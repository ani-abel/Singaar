<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/29/2019
 * Time: 10:05 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $todo_id = $_POST["todo_id"];

    if( isset($todo_id) ){
        deleteToDo($todo_id);
    }
}