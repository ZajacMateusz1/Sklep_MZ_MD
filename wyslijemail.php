<?php
$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$wygasanie = date("Y-m-d H:i:s", time() + 60 * 30);
require_once "polbaza.php";
$sql = "update users
        set reset_token = ?, reset_token_time = ? where email = ?";
$stmt = mysqli_stmt_init($conn);
$prepareStmt = mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "sss", $token_hash, $wygasanie, $email);
mysqli_stmt_execute($stmt);
?>