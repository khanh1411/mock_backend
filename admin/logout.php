<?php require_once("layouts/header.php"); ?>

<?php 

$session->logout();
redirect("login.php");