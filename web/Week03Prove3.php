<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="Week3Prove.js"></script>
    
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