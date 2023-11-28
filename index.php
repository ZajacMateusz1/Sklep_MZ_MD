<?php
session_start();
require_once "polbaza.php";
if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalogowano</title>
</head>
<body>
<div class=glowny>
<p>Udało ci się zalogować</p>
<a href="wyloguj.php">Wyloguj się</a>
</div>
</body>
</html>