<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Cart</title>
        <link rel="stylesheet" type="text/css" href="Week3Prove.css">
        <script src="Week3Prove.js"></script>
        
        <style>
            p {
            
            }
            img {
                border-radius: 50%;
                width: 125px;
                height: auto;
            }
            
            .div1 {
                flex-wrap: wrap;
                padding-top: 10pt;
                float: left;
            }
            .div2 {
                flex-wrap: wrap;
                margin-left: 175pt;
            }
            
            .div3 {
                flex-wrap: wrap;
                float: right;
                margin-right: 150px;
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .div4 {
                flex-wrap: wrap;
                padding-top: 10pt;
            }
            
            .div5 {
                float: left;
            
            }
            
            .div6 {
                flex-wrap: nowrap;
                padding-top: 75pt;
                float: right;
            }
            
            .div7 {
                float: right;
                flex-wrap: nowrap;
            }
            
            .divRow {
                display: flex;
                flex-wrap: wrap;
                margin-top; 0px;
            }
            
            h1 {
                font-family: fantasy, cursive;
                font-size: 50pt;
                text-align: center;
            }
            
            h2 {
                font-family: fantasy, cursive;
                font-size: 20pt;
                
            }
            
            h3 {
                font-family: fantasy, cursive;
                font-size: 30pt;
                padding-top: 25pt;
                margin-bottom: 0pt;
                
            }
            
            body {
                background-color: blanchedalmond;
            }
            
            .btnLink {
                font-family: helvetica, arial; 
                font-size: 20pt;
                background-color: coral;
                color: white;
            }
            
           .btnLink2 {
                font-family: helvetica, arial; 
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: right;
                padding-right: 10pt;
                padding-left: 10pt;
            
            }
            
            .btnLink3 {
                font-family: helvetica, arial; 
                font-size: 20pt;
                background-color: chocolate;
                color: white;
                float: right;
                padding-right: 10pt;
                padding-left: 10pt;
                border-radius: 20%;
            }
            
            .btnLink4 {
                font-family: helvetica, arial; 
                font-size: 15pt;
                color: coral;
                float: right;
            }
            
            
            .chLabel {
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .p1 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
                margin-top: 0pt;
            }
            
            .p2 {
                font-family: Helvetica, Arial;
                font-size: 30pt;
                margin-top: 10pt;
                float: right;
            }
            
            .p3 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
                padding-top: 45pt;
                padding-left: 175pt;
                float: right;
            }
            
            .p4 {
                font-family: Helvetica, Arial;
                font-size: 15pt;
            }
            
            .p5 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .btnSubmit {
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: right;
            }
        </style>

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