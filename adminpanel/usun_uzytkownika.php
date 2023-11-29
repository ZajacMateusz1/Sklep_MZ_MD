<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function usunUzytkownika($login) {
    global $conn;

    $sql = "DELETE FROM users WHERE login = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $login);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $login_do_usuniecia = $_POST['login'];

    if (!empty($login_do_usuniecia)) {
        $usuniecieUzytkownika = usunUzytkownika($login_do_usuniecia);

        if ($usuniecieUzytkownika) {
            echo 'Użytkownik został usunięty.';
        } else {
            $bledy[] = 'Wystąpił problem podczas usuwania użytkownika.';
        }
    } else {
        $bledy[] = 'Podaj login użytkownika do usunięcia.';
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
    <title>Usuń użytkownika</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Usuń użytkownika</h2>
    <form method="post" action="">
        <label for="login">Login użytkownika do usunięcia:</label>
        <input type="text" name="login" required>

        <button type="submit">Usuń użytkownika</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>