<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
<div class="glowny">
<?php
$bledy = array();

if (isset($_POST["log"])) {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    if (empty($login) || empty($haslo)) {
        array_push($bledy, "Wszystkie pola są wymagane");
    } else {
        require_once "polbaza.php";
        $sql = "select * from users where login = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $login);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $logo = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            if ($logo) {
                if (password_verify($haslo, $logo["haslo"])) {
                    session_start();
                    $_SESSION["zalogowany"] = true;
                    header("Location: index.php");
                    die();
                } else {
                    array_push($bledy, "Podany login lub hasło nie jest poprawne");
                }
            } else {
                array_push($bledy, "Podany login lub hasło nie jest poprawne");
            }
        } else {
            die("Coś poszło nie tak");
        }
    }
}

if (isset($_POST["log"]) && count($bledy) > 0) {
    foreach ($bledy as $blad) {
        echo "<div class='alert alert-danger'>$blad</div>";
    }
}
?>
<form action="logowanie.php" method="post">
    <input type="text" name="login" placeholder="Podaj login"> </br>
    <input type="password" name="haslo" placeholder="Podaj hasło"> </br>
    <input type="submit" value="Zaloguj się" name="log"> </br>
    <p>Nie masz jeszcze konta ?</p> </br>
    <a href="rejestracja.php">Zarejestruj się</a>
</form>
</div>
</body>
</html>