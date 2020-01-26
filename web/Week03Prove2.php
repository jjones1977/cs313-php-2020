<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Cart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="Week3Prove.js"></script>
        
       
    </head>
    <body>
    <div class="div4">
        <div>
            <a href="Week03Prove.php"><p class="btnLink2">Continue Shopping</p></a>
        </div>
        <div>
            <h1>The Chocolate Store</h1><hr>
        </div>
        
        <h3>Your Order</h3><br>
        
        <?php
        //Need to set the total to 0 initially
        $amountTotal = 0;
        //If there's something in the cart, add the price
        //and echo
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            
            $chocolates = $_SESSION['cart'];
            
            foreach ($chocolates as $chocolate) {
                
                $chocolate_clean = htmlspecialchars($chocolate);
                $amount = 0;
                if ($chocolate_clean == "Chocolate Covered Pretzels"){
                    $amount = 3;
                    $amountTotal = $amountTotal + $amount;
                }
                elseif ($chocolate_clean == "Sea Salt Caramels"){
                    $amount = 5;
                    $amountTotal = $amountTotal + $amount;
                }
                elseif ($chocolate_clean == "Turtles"){
                    $amount = 5;
                    $amountTotal = $amountTotal + $amount;
                }
                elseif ($chocolate_clean == "Honeycomb"){
                    $amount = 3;
                    $amountTotal = $amountTotal + $amount;
                }
                elseif ($chocolate_clean == "Dark Chocolate Mints"){
                    $amount = 5;
                    $amountTotal = $amountTotal + $amount;
                }
                
                echo "<p class='p1'>$chocolate_clean -- $$amount</p>";
            }
        }
        else {
            echo "<p class='p1'>You do not have anything in your cart</p>";
        }?>

        <hr>
            
                <div class="div5">
                    <?
                        echo "<p class='p2'>Total:  $$amountTotal</p>";
                    ?>
                </div>
                <div class="div7">
                    <div>
                        <a href="Week03Prove3.php" class="btnLink3"><p>Make Purchase</p></a>
                    </div>
                    <a href="Week03ProveSessionDestroy.php" class="btnLink4"><p>Empty Cart</p></a>
                    
                </div>
                
                    
                
            
    </div>
    
    </body>
</html>