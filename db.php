<?php
$mysql= new mysqli("localhost","root","Radhe.184","techhunt");
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}
?>

