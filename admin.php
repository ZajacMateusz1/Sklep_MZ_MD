<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="styl1.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Witaj w panelu administratora</h1>
        </header>
        <main>
            <section>
                <div class="produkty">
                    <h2>Zarządzanie Produktami</h2>
                    <ul>
                        <li><a href="adminpanel/dodaj_produkt.php">Dodaj nowy produkt</a></li>
                        <li><a href="adminpanel/usun_produkt.php">Usuń produkt</a></li>
                    </ul>
                </div>
                <div class="users">
                    <h2>Zarządzanie Użytkownikami</h2>
                    <ul>
                        <li><a href="">Ręczne dodawanie nowego użytkownika</a></li>
                        <li><a href="">Usuń użytkownika</a></li>
                    </ul>
                </div>
                <div class="kategorie">
                    <h2>Zarządzanie Kategoriami</h2>
                    <ul>
                        <li><a href="">Dodaj nową kategorię</a></li>
                        <li><a href="">Usuń kategorię</a></li>
                    </ul>
                </div>
            </section>
            <section>
                <div class="wybierz-tabele">
                    <h2>Wybierz tabelę:</h2>
                    <form method="post" action="">
                        <label for="wybor_tabeli">Wybierz tabelę:</label>
                        <select name="wybor_tabeli" id="wybor_tabeli">
                            <option value="produkty">Produkty</option>
                            <option value="users">Users</option>
                            <option value="kategorie">Kategorie</option>
                        </select>
                        <button type="submit" name="pokaz_dane">Pokaż dane</button>
                    </form>
                </div>
            </section>
            <section>
                <div class="dane">
                <?php
if (isset($_POST['pokaz_dane']) && isset($_POST['wybor_tabeli'])) {
    $wybrana_tabela = $_POST['wybor_tabeli'];
    include 'polbaza.php'; 

    $sql = "SELECT * FROM $wybrana_tabela";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr>";

        $row = $result->fetch_assoc();
        foreach ($row as $key => $value) {
            echo "<th>$key</th>";
        }

        echo "</tr></thead>";
        echo "<tbody>";

        do {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        } while ($row = $result->fetch_assoc());

        echo "</tbody></table>";
    } else {
        echo "Brak danych do wyświetlenia.";
    }
}
?>
                </div>
            </section>
        </main>
        <footer>
            <a class="logout" href="wyloguj.php">Wyloguj się</a>
        </footer>
    </div>
</body>
</html>