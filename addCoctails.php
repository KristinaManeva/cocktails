<?php
session_start();  // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cocktail</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #444;
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
            font-weight: bold;
        }

        main {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #222;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #f76c6c;
            color: white;
            font-size: 16px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #f45151;
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
        <a href="#" class="logo">My Cocktails</a>
       
      
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
        <h1>Add a New Cocktail</h1>
        <form action="addCoctails_logic.php" method="POST">
            <label for="cocktailName">Cocktail Name:</label>
            <input type="text" id="cocktailName" name="cocktailName" placeholder="Enter cocktail name" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" placeholder="Describe the cocktail" required></textarea>
            <button type="submit">Add Cocktail</button>
        </form>
    </main>
</body>
</html>
