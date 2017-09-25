<?php
$mysql= new mysqli("localhost","root","","techhunt");
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}
?>

