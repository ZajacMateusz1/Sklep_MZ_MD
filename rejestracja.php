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
    if (isset($_POST["submit"])) {
        $login = $_POST["login"];
        $email = $_POST["email"];
        $haslo = $_POST["haslo"];
        $haslo2 = $_POST["haslo2"];
        $bledy = array();
    if (empty($login) OR empty($email) OR empty($haslo) OR empty($haslo2) ) {
        array_push($bledy, "wszystkie pola są wymagane");
    } 
    if (!filter_var($email, FILTER_VALIDATE)) {
        array_push($bledy, "Niepoprawny format emaila")
    }
    }
    ?>
<form action="rejestracja.php" method="post">
    <input type="text" name="login" placeholder="login"> </br>
    <input type="email" name="email" placeholder="email"> </br>
    <input type="text" name="haslo" placeholder="Haslo"> </br>
    <input type="text" name="haslo2" placeholder="Powtorz haslo"> </br>
    <input type="submit" value="Zarejestruj się" name="wys">    
</form>
    </div>
</body>
</html>