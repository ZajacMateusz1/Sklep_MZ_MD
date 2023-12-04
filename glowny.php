<?php
session_start();
if (!isset($_SESSION['koszyk'])) {
    $_SESSION['koszyk'] = array();
}
include 'polbaza.php';
if (isset($_POST['dodaj_do_koszyka'])) {
    $produkt_id = $_POST['produkt_id'];
    if (!in_array($produkt_id, $_SESSION['koszyk'])) {
        $_SESSION['koszyk'][] = $produkt_id;
    }
}

$query = "SELECT * FROM produkty";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty</title>\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="glowny.css">
</head>
<body>
<a href="koszyk.php"><i class="fas fa-shopping-cart"></i></a>
<h2>Lista Produktów</h2>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='product-card'>";
    echo "<p>ID Produktu: {$row['id_produktu']}</p>";
    echo "<p>Nazwa Produktu: {$row['nazwa_produktu']}</p>";
    echo "<p>Cena: {$row['cena']}</p>";
    echo "<p>Ile Dostępne: {$row['ile_dostepne']}</p>";

    echo "<form method='post' action='glowny.php'>";
    echo "<input type='hidden' name='produkt_id' value='{$row['id_produktu']}'>";
    echo "<button type='submit' name='dodaj_do_koszyka'>Dodaj do koszyka</button>";
    echo "</form>";

    echo "</div>";
}
?>

<?php
mysqli_close($conn);
?>

</body>
</html>