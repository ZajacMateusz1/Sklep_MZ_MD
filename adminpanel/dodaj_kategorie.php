<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function dodajNowaKategorie($nazwa_kategorii) {
    global $conn;

    $sql = "INSERT INTO kategorie (nazwa_kategorii) VALUES (?)";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $nazwa_kategorii);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_kategorii = $_POST['nazwa_kategorii'] ?? '';

    if (empty($nazwa_kategorii)) {
        $bledy[] = 'Wprowadź nazwę kategorii.';
    } else {
        $dodanieKategorii = dodajNowaKategorie($nazwa_kategorii);

        if ($dodanieKategorii) {
            echo 'Kategoria została dodana.';
        } else {
            $bledy[] = 'Wystąpił problem podczas dodawania kategorii.';
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
    <title>Dodaj nową kategorię</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Dodaj nową kategorię</h2>
    <form method="post" action="">
        <label for="nazwa_kategorii">Nazwa kategorii:</label>
        <input type="text" name="nazwa_kategorii" required>

        <button type="submit">Dodaj kategorię</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>