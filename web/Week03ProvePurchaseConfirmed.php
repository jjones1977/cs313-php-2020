<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Confirmed</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    
        
 
    </head>
    <body>
        <h1>The Chocolate Store</h1><hr>

        <?php
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();

            echo "<p class='p1'>Congratulations! You've completed your chocolate order. Yummy deliciousness will ship in the next 2-3 business days.</p>";
        
        ?>
        
        <a href="Week03Prove.php" class="btnLink"><p>Would you like to continue shopping?</p></a>

    </body>
</html>