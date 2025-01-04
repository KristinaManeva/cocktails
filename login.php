<?php
session_start();  // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login</title>
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


        <!-- Login Form -->
        <form action="login_logic.php" method="POST">
            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Geslo" autocomplete="off" required>
            </div>

            <div class="input-submit">
                <button type="submit" class="submit-btn">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
