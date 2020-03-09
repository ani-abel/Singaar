<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/8/2019
 * Time: 10:57 PM
 */
require_once("../PHP_classes/initialize.php");

if( isset($_GET['token'], $_GET['user']) ){
    SignUp::activateAccount($_GET['token'], $_GET['user']);
}
else redirect_to("../php/sign_up.php");