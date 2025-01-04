<?php
// Preverjanje parametra za sortiranje, podprto za ASC in DESC
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc';  // sortiranje po 'id'


$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'DSR';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Povezava je neuspešna: " . $conn->connect_error);
}

// Gradnja SQL poizvedbe glede na parameter za sortiranje
switch($sort) {
    case 'id_desc':
        $sql = "SELECT id, name, description FROM recipes ORDER BY id DESC";
        break;
    case 'id_asc':
    default:
        $sql = "SELECT id, name, description FROM recipes ORDER BY id ASC";
        break;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Ime</th><th>Opis</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ni podatkov.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Sortiranje po ID</title>
</head>
<body>
    <!-- Oblika za sortiranje -->
    <form method="GET" action="">
        <label for="sort">Sortiraj po ID:</label>
        <select name="sort" id="sort">
            <option value="id_asc" <?php if($sort == 'id_asc') echo 'selected'; ?>>ID - Naraščajoče</option>
            <option value="id_desc" <?php if($sort == 'id_desc') echo 'selected'; ?>>ID - Padajoče</option>
        </select>
        <button type="submit">Potrdi</button>
    </form>
</body>
</html>
