<?php
include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = htmlspecialchars($_POST['ime']);
    $priimek = htmlspecialchars($_POST['priimek']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  
    $sql = "INSERT INTO Uporabnik (idUporabnik, ime, priimek, email, geslo) VALUES (UUID(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        
        $stmt->bind_param("ssss", $ime, $priimek, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registracija uspešna!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Napaka pri registraciji: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Napaka pri pripravi SQL poizvedbe: " . $conn->error . "');</script>";
    }

  
    $conn->close();
}
?>
