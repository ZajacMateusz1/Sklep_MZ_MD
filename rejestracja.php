<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <div class="glowny">
    <?php
$bledy = array();

if (isset($_POST["wys"])) {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    $haslo2 = $_POST["haslo2"];

    if (empty($login) || empty($email) || empty($haslo) || empty($haslo2)) {
        array_push($bledy, "Wszystkie pola są wymagane");
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($bledy, "Niepoprawny format emaila");
    }
    if (strlen($haslo) < 8) {
        array_push($bledy, "Hasło musi mieć co najmniej 8 znaków!");
    }
    if ($haslo !== $haslo2) {
        array_push($bledy, "Hasła nie są identyczne");
    }
}
if (isset($_POST["wys"]) && count($bledy) > 0) {
    foreach ($bledy as $blad) {
        echo "<div class='alert alert-danger'>$blad</div>";
    }
}
?>
<form action="rejestracja.php" method="post">
    <input type="text" name="login" placeholder="login"> </br>
    <input type="email" name="email" placeholder="email"> </br>
    <input type="password" name="haslo" placeholder="Haslo"> </br>
    <input type="password" name="haslo2" placeholder="Powtorz haslo"> </br>
    <input type="submit" value="Zarejestruj się" name="wys">    
</form>
    </div>
</body>
</html>