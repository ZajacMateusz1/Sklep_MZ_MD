<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="styl.css">
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
        } elseif (strlen($haslo) < 8) {
            array_push($bledy, "Hasło musi mieć co najmniej 8 znaków!");
        } elseif (!preg_match("/[A-Z]/", $haslo) || !preg_match("/[0-9]/", $haslo)) {
            array_push($bledy, "Hasło musi zawierać co najmniej jedną dużą literę i jedną cyfrę");
        } elseif ($haslo !== $haslo2) {
            array_push($bledy, "Hasła nie są identyczne");
        } 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($bledy, "Niepoprawny format emaila");
        }
        
        if (count($bledy) === 0) {
            require_once "polbaza.php";
            $sprawdz = "select * from users where login = ? or email = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sprawdz);
            mysqli_stmt_bind_param($stmt, "ss", $login, $email);
            mysqli_stmt_execute($stmt);
            $czyjest = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($czyjest) > 0) {
                array_push($bledy, "Login lub email jest już zajęty </br> Spróbuj ponownie!");
            } else {
                $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
                $sql = "insert into users (login, email, haslo) values (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $login, $email, $haslo_hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Twoje konto zostało założone.</div>";
                } else {
                    die("Coś poszło nie tak");
                }
            }
        }
    }

    if (isset($_POST["wys"]) && count($bledy) > 0) {
        foreach ($bledy as $blad) {
            echo "<div class='alert alert-danger'>$blad</div>";
        }
    }
    ?>
    <form action="rejestracja.php" method="post">
        <input type="text" name="login" placeholder="login" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>"> </br>
        <input type="email" name="email" placeholder="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"> </br>
        <input type="password" name="haslo" placeholder="Haslo"> </br>
        <input type="password" name="haslo2" placeholder="Powtorz haslo"> </br>
        <input type="submit" value="Zarejestruj się" name="wys"> </br>
    </form>
    <p>Masz już konto ?
    <a href="logowanie.php">Zaloguj się</a>
    </p>
    </div>
</body>
</html>