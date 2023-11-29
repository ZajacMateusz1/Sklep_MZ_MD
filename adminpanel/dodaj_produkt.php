<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function dodajNowyProdukt($nazwa_produktu, $cena, $ile_dostepne) {
    global $conn;

    $sql = "INSERT INTO produkty (nazwa_produktu, cena, ile_dostepne) VALUES (?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->bind_param('sdi', $nazwa_produktu, $cena, $ile_dostepne);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_produktu = $_POST['nazwa_produktu'] ?? '';
    $cena = $_POST['cena'] ?? 0;
    $ile_dostepne = $_POST['ile_dostepne'] ?? 0;

    if (empty($nazwa_produktu) || $cena <= 0 || $ile_dostepne < 0) {
        $bledy[] = 'Wprowadź poprawne dane.';
    } else {
        $dodanieProduktu = dodajNowyProdukt($nazwa_produktu, $cena, $ile_dostepne);

        if ($dodanieProduktu) {
            echo 'Produkt został dodany.';
        } else {
            $bledy[] = 'Wystąpił problem podczas dodawania produktu.';
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
    <title>Dodaj nowy produkt</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Dodaj nowy produkt</h2>
    <form method="post" action="">
        <label for="nazwa_produktu">Nazwa produktu:</label>
        <input type="text" name="nazwa_produktu" required>

        <label for="cena">Cena:</label>
        <input type="number" name="cena" required>

        <label for="ile_dostepne">Ilość dostępna:</label>
        <input type="number" name="ile_dostepne" required>

        <button type="submit">Dodaj produkt</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>