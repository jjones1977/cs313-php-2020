<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cart Emptied</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="Week3Prove.js"></script>

    </head>
    <body>
        
        <h1>The Chocolate Store</h1><hr>

        <?php
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();

            echo "<p class='p1'>Your cart is now empty.</p>";
        
        ?>
        
        <a href="Week03Prove.php" class="btnLink"><p>Would you like to continue shopping?</p></a>

    </body>
</html>