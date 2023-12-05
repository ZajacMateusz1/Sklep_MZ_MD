<?php
session_start();

if (isset($_POST['usun_z_koszyka'])) {
    $produkt_id = $_POST['produkt_id'];

    $_SESSION['koszyk'] = array_diff($_SESSION['koszyk'], array($produkt_id));
    header('location: koszyk.php');
    exit();
}
?>