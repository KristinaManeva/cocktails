<?php
include 'db_connection.php';

if(isset($_GET['id'])) {
    $recipe_id = $_GET['id'];


    $sql = "DELETE FROM recipes WHERE id = $recipe_id";

    if ($conn->query($sql) === TRUE) {
        echo "Recipe deleted successfully.";
        header('Location: Recepies.html'); 
        exit();
    } else {
        echo "Error deleting recipe: " . $conn->error;
    }
}

$conn->close();
?>
