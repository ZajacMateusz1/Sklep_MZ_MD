<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function dodajNowegoUzytkownika($login, $email, $haslo) {
    global $conn;

    $hash_haslo = password_hash($haslo, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (login, email, haslo) VALUES (?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->bind_param('sss', $login, $email, $hash_haslo);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $email = $_POST['email'] ?? '';
    $haslo = $_POST['haslo'] ?? '';

    if (empty($login) || empty($email) || empty($haslo)) {
        $bledy[] = 'Wprowadź poprawne dane.';
    } else {
        $dodanieUzytkownika = dodajNowegoUzytkownika($login, $email, $haslo);

        if ($dodanieUzytkownika) {
            echo 'Użytkownik został dodany.';
        } else {
            $bledy[] = 'Wystąpił problem podczas dodawania użytkownika.';
        }
    }
}

if (!empty($bledy)) {
    foreach ($bledy as $blad) {
        echo "<div class='alert alert-danger'>$blad</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj nowego użytkownika</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Dodaj nowego użytkownika</h2>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="haslo">Hasło:</label>
        <input type="text" name="haslo" required>

        <button type="submit">Dodaj użytkownika</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>