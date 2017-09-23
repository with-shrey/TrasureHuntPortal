<?php
session_start();
$_SESSION['log_in'] == 0;
session_unset();
session_destroy();

header('Location: ' . 'login.php');
?>