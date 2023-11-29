<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function usunProdukt($id_produktu) {
    global $conn;

    $sql = "DELETE FROM produkty WHERE id_produktu = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $id_produktu);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produktu'])) {
    $id_produktu_do_usuniecia = $_POST['id_produktu'];

    if ($id_produktu_do_usuniecia > 0) {
        $usuniecieProduktu = usunProdukt($id_produktu_do_usuniecia);

        if ($usuniecieProduktu) {
            echo 'Produkt został usunięty.';
        } else {
            $bledy[] = 'Wystąpił problem podczas usuwania produktu.';
        }
    } else {
        $bledy[] = 'Nieprawidłowy identyfikator produktu do usunięcia.';
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
    <title>Usuń produkt</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Usuń produkt</h2>
    <form method="post" action="">
        <label for="id_produktu">ID produktu do usunięcia:</label>
        <input type="number" name="id_produktu" required>

        <button type="submit">Usuń produkt</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>