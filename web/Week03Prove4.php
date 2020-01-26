<?php
    // Start the session
    session_start();

      
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        $a = "yep";
        $cartArray = $_SESSION['cart'];
    }
    else {
        $cartArray = array();
    }
        
    $fName = htmlspecialchars($_POST["fName"]);
    $lName = htmlspecialchars($_POST["lName"]);
    $streetAddress = htmlspecialchars($_POST["streetAddress"]);
    $city = htmlspecialchars($_POST["city"]);
    $state = htmlspecialchars($_POST["state"]);
    $zipCode = htmlspecialchars($_POST["zip"]);
    $chocolates = $cartArray;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="Week3Prove.js"></script>
        
 
    </head>
    
    <body>
        <div>
            <a href="Week03Prove2.php" class="btnLink2"><? echo "Cart: " . count($cartArray); ?></a>
        </div>
        <div>
            <h1>The Chocolate Store</h1><hr>
        </div>
        <h5>Please confirm your purchase.</h5>
        
        <h2>Address</h2>
        <p class="p1"><?=$fName ?> <?=$lName ?><br>
           <?=$streetAddress ?><br>
           <?=$city ?>, <?=$state ?> <?=$zipCode ?></p>
        
        <h2>Your Order</h2>
        <? 
    //Print out contents of cart with price
        $amountTotal = 0;
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
            
            
                <?
                    echo "<p class='p2'>Total:  $$amountTotal</p>";
                ?>
            
        
        <a href="Week03ProvePurchaseConfirmed.php" class="btnSubmit2"><p>Confirm Purchase</p></a>
    </body>
    
</html>