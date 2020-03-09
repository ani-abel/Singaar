<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 3/4/2019
 * Time: 1:41 AM
 */
require_once("../PHP_classes/initialize.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //get fields here
    $n_id = $_POST["n_id"];
    $n_from_user = $_POST["n_from_user"];

    if (isset($n_id, $n_from_user))
        Artists::declineContactInvitation($n_from_user, $n_id);
}
