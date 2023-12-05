<?php
session_start();
require 'polbaza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imie = mysqli_real_escape_string($conn, $_POST['imie']);
    $nazwisko = mysqli_real_escape_string($conn, $_POST['nazwisko']);
    $adres_dostawy = mysqli_real_escape_string($conn, $_POST['adres_dostawy']);

    $orderedProducts = $_SESSION['koszyk'];

    $insertOrderQuery = "INSERT INTO zamowienia (imie, nazwisko, adres_dostawy, zamowione_produkty) 
                        VALUES ('$imie', '$nazwisko', '$adres_dostawy', '" . json_encode($orderedProducts) . "')";

    $result = mysqli_query($conn, $insertOrderQuery);

    if ($result) {
        $_SESSION['koszyk'] = array();
        echo "Zamówienie zostało złożone pomyślnie.";
    } else {
        echo "Wystąpił błąd podczas składania zamówienia: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie</title>
    <link rel="stylesheet" href="zamowienia.css">
</head>
<body>

<h2>Formularz Zamówienia</h2>

<form method="post" action="zamowienie.php">
    <label for="imie">Imię:</label>
    <input type="text" name="imie" required>

    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko" required>

    <label for="adres_dostawy">Adres dostawy:</label>
    <input type="text" name="adres_dostawy" required>

    <button type="submit">Złóż zamówienie</button>
</form>

<a href="koszyk.php">Powrót do koszyka</a>
<a href="wyswietl_zamowienia.php">Sprawdź wszystkie zamowienia</a>

</body>
</html>