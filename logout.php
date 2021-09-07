<?php
session_start();
session_destroy();
session_start();
$_SESSION["logoutSuccess"] = "You are now logged out successfully!";
header("Location: index.php");
exit();
?>