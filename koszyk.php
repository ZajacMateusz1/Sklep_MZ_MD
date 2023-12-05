<?php
session_start();
require 'polbaza.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link rel="stylesheet" href="koszyk.css">
</head>
<body>

<?php
if (isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])) {
    $produkty_ids = implode(',', $_SESSION['koszyk']);
    $query = "SELECT * FROM produkty WHERE id_produktu IN ($produkty_ids)";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='cart-item'>";
        echo "<p>ID: {$row['id_produktu']}</p>";
        echo "<p>Nazwa: {$row['nazwa_produktu']}</p>";
        echo "<p>Cena: {$row['cena']}</p>";

        echo "<form method='post' action='usun_z_koszyka.php'>";
        echo "<input type='hidden' name='produkt_id' value='{$row['id_produktu']}'>";
        echo "<button type='submit' name='usun_z_koszyka'>Usuń z koszyka</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "<p>Twój koszyk jest pusty.</p>";
}
?>
    <a class="str" href="zamowienie.php">Przejdź do zamówienia</a>
    <a href="glowny.php">Powrót na stronę główną</a>
</body>
</html>