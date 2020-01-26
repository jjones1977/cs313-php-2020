<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
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
            
            .btnSubmit2 {
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: left;
            }
        </style>
    </head>
    
    <body>
        
        <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $a = "yep";
            $cartArray = $_SESSION['cart'];
        }
        else {
            $cartArray = array();
        }
        ?>
        
        <div>
            <a href="Week03Prove2.php" class="btnLink2"><? echo "Cart: " . count($cartArray); ?></a>
        </div>
        <div>
            <h1>The Chocolate Store</h1><hr>
        </div>
        
        <form method="POST" action="Week03Prove4.php">
			<h4>Please enter your address:</h4>
            <br />

			<label for="name" class="addressLabel">First Name, Last Name: </label>
			<input type="text" id="fName" name="fName">
            <input type="text" id="lName" name="lName">
			<br />
            <br />
            
            <label for="streetAddress" class="addressLabel">Street Address: </label>
			<input type="text" id="streetAddress" name="streetAddress">
			<br />
            <br />

			<label for="cityStateZip" class="addressLabel">City, State, Zip Code: </label>
			<input type="text" id="city" name="city">
            <input type="text" id="state" name="state">
            <input type="text" id="zip" name="zip">
			<br />
            <br />
                    
            <input type="submit" value="Complete Purchase" class="btnSubmit2">
        </form>
        
        
    </body>
    
</html>