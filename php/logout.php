<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/7/2019
 * Time: 9:20 PM
 */
require_once("../PHP_classes/initialize.php");

if($session->is_logged_in()){
    $session->logout();
    redirect_to("./login.php");
}
else redirect_to($_SERVER['HTTP_REFERER']);