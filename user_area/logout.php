<?php


session_start();

session_unset();

header("Location: user_login.php");

echo "<script>window.open('../index.php','_self')</script>";

?>