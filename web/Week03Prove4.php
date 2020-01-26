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
            
            h4 {
                font-family: fantasy, cursive;
                font-size: 20pt;
                padding-top: 25pt;
                margin-bottom: 0pt;
                
            }
                    
            h5 {
                font-family: fantasy, cursive;
                font-size: 30pt;
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
            
            .addressLabel {
                font-family: Helvetica, Arial;
                font-size: 15pt;
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
            
            .btnSubmit2 {
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: left;
                padding-right: 10pt;
                padding-left: 10pt;
            }
        </style>
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