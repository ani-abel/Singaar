<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/27/2019
 * Time: 10:56 PM
 */
require_once("../PHP_classes/initialize.php");

global $db;
$page = (isset($_GET['page']) ? $_GET['page'] : "");

$page1 = null;
if($page == "" || $page == 1)
    $page1 = 0;
else
    $page1 = ($page * 5) - 5;

echo $page1."<br>";

$rs = $db->query("select * from try_pagination ORDER BY id DESC LIMIT {$page1}, 5");

$id = 1;
while($row = $db->fetch_array($rs)){
    echo $id++ .". ".$row["name"]."<br><br>";
}

$rs = $db->query("select * from try_pagination ORDER BY id DESC");
$no_of_rows = $db->num_rows($rs);
$a = $no_of_rows/5;
$a = ceil($a);
echo $a."<br>";

$st_point = 1;
//$page1 = ($page1 > 0) ? $page1 : 5;
if(isset($page) && $page > 1){
    $st_point = ++$a;
}

echo "showing {$st_point} - {$page1} of {$no_of_rows}<br><br>";

for($b = 1; $b <= $a; $b++){
    echo "<a href='./try_pagination.php?page={$b}' style='text-decoration: none;'>{$b} </a>";
}