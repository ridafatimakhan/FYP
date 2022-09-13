<?php
session_start();
unset($_SESSION["userID"]);
unset($_SESSION["userName"]);
unset($_SESSION["userRole"]);
unset($_SESSION['userFullName']);
header("location:signin.php");
exit();

?> 

