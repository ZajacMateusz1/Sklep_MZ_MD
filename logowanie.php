<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="styl.css">
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
            $sql = "SELECT * FROM users WHERE login = ?";
            $stmt = mysqli_stmt_init($conn);
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $login);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($haslo, $user["haslo"])) {
                        session_start();
                        $_SESSION["zalogowany"] = true;
                        if ($user["typ"] === "admin") {
                            header("Location: admin.php");
                        } else {
                            header("Location: index.php");
                        }
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
        <input type="text" name="login" placeholder="Podaj login" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>"> </br>
        <input type="password" name="haslo" placeholder="Podaj hasło" value=""> </br>
        <input type="submit" value="Zaloguj się" name="log"> </br>
    </form>
    <a href="zapom.php">Zapomniałeś hasła ?</a>
    <p>Nie masz jeszcze konta ?
        <a href="rejestracja.php">Zarejestruj się</a>
    </p>
</div>
</body>
</html>