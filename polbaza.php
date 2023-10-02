<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "baza_sklep";
$conn = mysqli_connect ($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Coś poszło nie tak");
}
?>