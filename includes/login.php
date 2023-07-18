<?php include 'db.php'; ?>
<?php include '../admin/includes/adminfunctions.php'; ?>
<?php session_start(); ?>
<?php


if (isset($_POST['login'])) {

  login($_POST['username'], $_POST['password']);

} 



?>