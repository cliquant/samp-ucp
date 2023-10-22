<?php 
session_start();
setcookie("user", "", time() - 1800, "/","", 0);
session_destroy();
header ("Location: index.php");
?>