<?php
$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$wygasanie = date("Y-m-d H:i:s", time() + 60 * 30);
require_once "polbaza.php";

$sql = "UPDATE users
        SET reset_token = ?, reset_token_time = ?
        WHERE email = ?";

$stmt = mysqli_stmt_init($conn);
$prepareStmt = mysqli_stmt_prepare($stmt, $sql);

if (!$prepareStmt) {
    die("Statement preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss", $token_hash, $wygasanie, $email);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    $mail = require __DIR__ . "/mailer.php";
    $mail->setFrom("noreply@example.com"); // Corrected method name
    $mail->addAddress($email);
    $mail->Subject = "Reset hasla";
    $mail->Body = <<<END
    Click <a href="#">Tutaj</a> 
    aby zrestartować twoje haslo.
    END;

    try {
        $mail->send();
        echo "Wiadomość została wysłana.";
    } catch (Exception $e) {
        echo "Wiadomość nie mogła zostać wysłana. Mailer error: {$mail->ErrorInfo}";
    }
} else {
    echo "Nie udało się zaktualizować tokena resetującego.";
}
?>