<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chocolate Store</title>
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
                padding-bottom: 50pt;
                
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
            }
            
            .chLabel {
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
    <div class="divRow">
    <div>
        <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $a = "yep";
            $previousCart = $_SESSION['cart'];
        }
        else{
            $a = "Nope";
        }?>
        
        <div>
        <h1>The Chocolate Store</h1><hr>
            
        </div>
        
        
        <form method='post' id='userform' >
            
            <h2>Come peruse our delectable assortment of delicious chocolates.</h2><br />
			<div>
                <div class="div1">
                    <input type="checkbox" name="chocolates[]" id="chocolate-cp" value="Chocolate Covered Pretzels"><label for="chocolate-cp" class="chLabel">Chocolate Covered Pretzels</label></div>
                <div class="div2">
                    <img src="Pretzels.jpg" alt="Chocolate Covered Pretzels" style="margin-left:30px;">
                    <div class="div3"><p>$3</p></div>
                </div>
            </div><br />
            <div>
                <div class="div1">
                    <input type="checkbox" name="chocolates[]" id="chocolate-ssc" value="Sea Salt Caramels"><label for="chocolate-ssc" class="chLabel">Sea Salt Carmels</label>
                </div>
                <div class="div2">
                    <img src="SeaSaltCaramels.jpg" alt="Sea Salt Caramels" style="margin-left:145px;">
                    <div class="div3"><p>$5</p></div>
                </div>
                
            </div><br />
            <div>
                <div class="div1">
                    <input type="checkbox" name="chocolates[]" id="chocolate-t" value="Turtles"><label for="chocolate-t" class="chLabel">Turtles</label>
                </div>
                <div class="div2">
                    <img src="Turtles.jpg" alt="Chocolate Turtles" style="margin-left:145px;">
                    <div class="div3"><p>$5</p></div>
                </div>
            </div><br />
            <div>
               <div class="div1"> 
			       <input type="checkbox" name="chocolates[]" id="chocolate-dcm" value="Dark Chocolate Mints"><label for="chocolate-dcm" class="chLabel">Dark Chocolate Mints</label>
                </div>
                <div class="div2">
                    <img src="Mints.jpg" alt="Dark Chocolate Mints" style="margin-left:105px;">
                    <div class="div3"><p>$5</p></div>
                </div>
            </div><br />
            <div>
                <div class="div1">
			       <input type="checkbox" name="chocolates[]" id="chocolate-hc" value="Honeycomb"><label for="chocolate-hc" class="chLabel">Honeycomb</label>
                </div>
                <div class="div2">
                    <img src="Honeycomb.jpg" alt="Chocolate Covered HoneyComb" style="margin-left:145px;">
                    <div class="div3"><p>$3</p></div>
                </div>
            </div><br />
			<br />
            
            <input type="submit" value="Add to Cart" class="btnSubmit">

		</form>
        
        <?php 
        //If selections were made, add the selections to the 
        //array that will be added to the session
        if (isset($_POST['chocolates'])){
            //if there wasn't anything in the array to begin with
            //add the current selections
            if ($a == "Nope"){
            
               $cartArray = ($_POST['chocolates']);
        
               $_SESSION['cart'] = $cartArray;
            }
            //if there WAS something in the array to begin with,
            //still add the current selections but don't override the 
            //past selections
            elseif ($a == "yep"){
                $cartArray = ($_POST['chocolates']);
                
                foreach ($previousCart as $chocolate) {
                
                    $chocolate_clean = htmlspecialchars($chocolate);
                    
                    array_push($cartArray, $chocolate_clean);
                
                }
        
               $_SESSION['cart'] = $cartArray;
            }
        }
        //If someone clicked the button but didn't make a selection
        //empty array is made so we don't get error messages
        elseif (!isset($_POST['chocolates']) && $a == "Nope") {
            $cartArray = array();
        }
        //And if someone clicked the button but didn't make a selection
        //but they had something in the cart...
        //Let's not lose that something
        elseif (!isset($_POST['chocolates']) && $a == "yep"){
            $cartArray = $previousCart;
        }
        ?>
    </div>
        <div >
            <a href="Week03Prove2.php" class="btnLink2"><? echo "Cart: " . count($cartArray); ?></a>
        </div>
    </div>    
    </body>
</html>