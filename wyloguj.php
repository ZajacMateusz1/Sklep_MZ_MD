<?php
session_start();
session_destroy();
header("Location: logowanie.php"); 
exit();
?>