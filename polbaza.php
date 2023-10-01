<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "Baza_sklep";
$conn = mysqli_connect ($hostName, $dbUser, $dbPassword, $dbName)
if (!conn) {
    die("Coś poszło nie tak")
}
?>