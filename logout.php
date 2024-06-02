<?php

session_start();
unset($_SESSION["User_ID"]);
unset($_SESSION["user_role"]);
header("Location:index.php");
?>


