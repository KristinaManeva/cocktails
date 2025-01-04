<?php
session_start();  

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Query to check if the user exists with the entered email
    $sql = "SELECT idUporabnik, geslo FROM Uporabnik WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
       
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['geslo'])) {
                // Password is correct, user is logged in
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_id'] = $row['idUporabnik'];  // Store the user's ID in the session
                echo "<script>alert('Login successful!'); window.location.href = 'index.php';</script>";
            } else {
                // invalid password
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            // user not found
            echo "<script>alert('User not found!');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
