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
    <title>Recepies page</title>
</head>
  </head>

<body>
<header>
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
<section class="Recepies">
    
    <div class="recepies-section">
        <div class="recepies-card">
            <img src="css/Blackberry-Bourbon-Smash-9084_Resplendent-Kitchen-1.jpg" alt="Cocktail 1">
            <h2>Blackberry</h2>
            <p>Some description about Cocktail 1.</p>
            <a href="recipe-page.html" class="view-recepie-btn">View Recipe</a> 
        </div>

        <div class="recepies-card">
            <img src="css/Mai-Tai-80422f5.jpg" alt="Cocktail 2">
            <h2>Mai Tai</h2>
            <p>Some description about Cocktail 2.</p>
            <a href="recipe-page.html" class="view-recepie-btn">View Recipe</a> 
        </div>

        <div class="recepies-card">
            <img src="css/virgin-mojito-3.png" alt="Cocktail 3">
            <h2>Mojito</h2>
            <p>Some description about Cocktail 3.</p>
            <a href="recipe-page.html" class="view-recepie-btn">View Recipe</a> 
        </div>
    </div>
</section>
</header>  
</body>
</html>
