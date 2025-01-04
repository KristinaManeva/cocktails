<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Registration</title>

    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // jQuery for form validation
        $(document).ready(function() {
            $('form').submit(function(event) {
                var valid = true;
               
                $('.input-field').each(function() {
                    if ($(this).val() === "") {
                        valid = false;
                        $(this).css('border-color', 'red');
                    } else {
                        $(this).css('border-color', '#ccc');
                    }
                });
                
                if (!valid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                    alert("Please fill all the fields.");
                }
            });

            // Optional: Show password toggle functionality
            $('.password-toggle').click(function() {
                var passField = $('input[name="password"]');
                var passType = passField.attr('type');
                if (passType === 'password') {
                    passField.attr('type', 'text');
                    $(this).text('Hide');
                } else {
                    passField.attr('type', 'password');
                    $(this).text('Show');
                }
            });
        });
    </script>
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
    
    <div class="registration">
        <h2>Register Now</h2>
        <!-- Registration form -->
        <form action="registration_logic.php" method="POST">
            <div class="input-box">
                <input type="text" name="ime" class="input-field" placeholder="Ime" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="text" name="priimek" class="input-field" placeholder="Priimek" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Geslo" autocomplete="off" required>
                <!-- Apply the same design to the toggle button -->
                <button type="button" class="submit-btn password-toggle">Show</button>
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn">Potrdi</button>
            </div>
        </form>        
    </div>
</body>
</html>
