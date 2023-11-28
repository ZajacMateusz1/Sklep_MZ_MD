<?php
session_start();
if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<div class="wrapper">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Witaj w panelu administratora</h1>
    </header>
    <main>
        <p>Wybierz co chcesz zrobic:</p>
        <section></section>
    </main>
<footer>
    <a class="logout" href="wyloguj.php">Wyloguj się</a>
</footer>
</div>
</body>
</html>