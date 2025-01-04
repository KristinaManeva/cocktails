<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Query to check if the user exists with the entered email
    $sql = "SELECT idUporabnik, geslo FROM Uporabnik WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the email to the prepared statement
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['geslo'])) {
                // Password is correct, user is logged in
                echo "<script>alert('Login successful!'); window.location.href = 'index.html';</script>";
            } else {
                // Invalid password
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            // User not found
            echo "<script>alert('User not found!');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
