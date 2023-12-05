<?php
session_start();
require_once 'polbaza.php';

if (isset($_POST['dodaj_do_koszyka'])) {
    $produkt_id = $_POST['produkt_id'];

    if (!isset($_SESSION['koszyk'])) {
        $_SESSION['koszyk'] = array();
    }

    if (!in_array($produkt_id, $_SESSION['koszyk'])) {
        $_SESSION['koszyk'][] = $produkt_id;
    }

    header('location: glowny.php');
    exit();
}
?>