<?php
session_start();  
?>
<?php
include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


$filter_date = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'asc';
$filter_name = isset($_GET['name_filter']) ? $_GET['name_filter'] : 'asc';

// Build SQL query with filters
$sql = "SELECT id, naziv, opis, datum_objave FROM SimpleKoktelj ORDER BY naziv $filter_name, datum_objave $filter_date";


$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Delete cocktail functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
   
    $delete_sql = "DELETE FROM SimpleKoktelj WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $delete_id);
    $delete_stmt->execute();
    header("Location: viewCocktails.php"); // Refresh page after deletion
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>View Cocktails</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
                min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgb(238, 231, 232);
        }

        header {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        header .navbar a {
            text-decoration: none;
            margin: 0 10px;
            color: #333;
            font-weight: normal;
            font-size: 1.3rem;
        }

        main {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 90%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: pink;
        }

        .filter-form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        
        }

        .filter-form select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .cocktail-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cocktail-item {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cocktail-item h2 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #444;
        }

        .cocktail-item p {
            margin-bottom: 5px;
            color: #666;
            line-height: 1.5;
        }

        .cocktail-item .date {
            font-size: 12px;
            color: #999;
        }

        .delete-button {
            background-color: grey;
            color: white;
            padding: 10px 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: darkred;
        }

        @media (max-width: 480px) {
            main {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="logo"></a>
        <img src="css/logo.png" alt="Logo" class="logo-img">

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="Recepies.php">Recepies</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- If logged in, show 'Log Out' and 'View Cocktails' -->
                <a href="viewCocktails.php">View Cocktails</a>
                <a href="addCoctails.php">Add Cocktails</a>
                <a href="logout.php">Log Out</a>
            <?php else: ?>
                <!-- If not logged in, show 'Log In' -->
                <a href="login.php">Login</a>
                <a href="Registration.php">Registration</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h1>Cocktail Recipes</h1>

        <!-- Filter Form -->
        <form class="filter-form" method="GET" action="">
            <div>
                <label for="date_filter">Sort by Date:</label>
                <select name="date_filter" id="date_filter">
                    <option value="asc" <?php echo $filter_date == 'asc' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="desc" <?php echo $filter_date == 'desc' ? 'selected' : ''; ?>>Descending</option>
                </select>
            </div>
            <div>
                <label for="name_filter">Sort by Name:</label>
                <select name="name_filter" id="name_filter">
                    <option value="asc" <?php echo $filter_name == 'asc' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="desc" <?php echo $filter_name == 'desc' ? 'selected' : ''; ?>>Descending</option>
                </select>
            </div>
            <button type="submit">Apply Filters</button>
        </form>

        <?php if ($result && $result->num_rows > 0): ?>
            <ul class="cocktail-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="cocktail-item">
                        <div>
                            <h2><?php echo htmlspecialchars($row['naziv']); ?></h2>
                            <p><?php echo htmlspecialchars($row['opis']); ?></p>
                            <p class="date">Published on: <?php echo htmlspecialchars($row['datum_objave']); ?></p>
                        </div>
                        <div>
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this cocktail?')">Delete</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No cocktails found!</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
