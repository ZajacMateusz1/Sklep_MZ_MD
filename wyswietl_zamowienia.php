<?php
include "polbaza.php";
$sql = "SELECT * FROM zamowienia";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id_zamowienia"] . "<br>";
        echo "Imię: " . $row["imie"] . "<br>";
        echo "Nazwisko: " . $row["nazwisko"] . "<br>";
        echo "Adres dostawy: " . $row["adres_dostawy"] . "<br>";
        echo "Status zamówienia: " . $row["status_zamowienia"] . "<br>";
        echo "Zamówione produkty: " . $row["zamowione_produkty"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprawdz zamowienia</title>
    <link rel="stylesheet" href="wys.css">
</head>
<body>
    <a href="glowny.php">Powrót na stronę główną</a>
</body>
</html>