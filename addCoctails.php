<?php
include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $naziv = isset($_POST['cocktailName']) ? htmlspecialchars($_POST['cocktailName']) : null;
    $opis = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;

    // Print sanitized values for debugging
    echo "Naziv: $naziv<br>";
    echo "Opis: $opis<br>";

    // Check if fields are filled
    if ($naziv && $opis) {
        // Prepare SQL query
        $sql = "INSERT INTO SimpleKoktelj (naziv, opis, datum_objave) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ss", $naziv, $opis);

            // Execute statement and handle success/error
            if ($stmt->execute()) {
                echo "<script>alert('Cocktail added successfully!'); window.location.href = 'index.html';</script>";
            } else {
                echo "<script>alert('Error adding cocktail: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing query: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill out all fields.');</script>";
    }

    // Close the connection
    $conn->close();
}
?>
