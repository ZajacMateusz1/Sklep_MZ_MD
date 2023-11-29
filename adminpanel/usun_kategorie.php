<?php
session_start();
require_once "../polbaza.php";

if (!isset($_SESSION["zalogowany"])) {
    header("Location: logowanie.php");
}

$bledy = [];

function usunKategorie($id_kategorii) {
    global $conn;

    $sql = "DELETE FROM kategorie WHERE id_kategorii = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $id_kategorii);

    return $query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_kategorii'])) {
    $id_kategorii_do_usuniecia = $_POST['id_kategorii'];

    if ($id_kategorii_do_usuniecia > 0) {
        $usuniecieKategorii = usunKategorie($id_kategorii_do_usuniecia);

        if ($usuniecieKategorii) {
            echo 'Kategoria została usunięta.';
        } else {
            $bledy[] = 'Wystąpił problem podczas usuwania kategorii.';
        }
    } else {
        $bledy[] = 'Nieprawidłowy identyfikator kategorii do usunięcia.';
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
    <title>Usuń kategorię</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h2>Usuń kategorię</h2>
    <form method="post" action="">
        <label for="id_kategorii">ID kategorii do usunięcia:</label>
        <input type="number" name="id_kategorii" required>

        <button type="submit">Usuń kategorię</button>
    </form>
    <a href="../admin.php">Przejdź do panelu administracyjnego</a>
</body>
</html>