<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: form_login.php");
exit(); }
?>
