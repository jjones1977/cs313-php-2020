<?php
    require("DBCon.php");
    session_start();
?>

<html>
    
<head>
    <title>Add Transactions</title>
    <link rel="stylesheet" type="text/css" href="style2.css">   
    
</head>
<body>
    <div>
    <div class="row">
        <div class="column">
            <img class="imgLogo" src="bank.JPEG" alt="Logo">
        </div>
        <div class="column">
            <h2>Bankon</h2>
        </div>
        <div class="column2">
            <a href="piggyBankAppWelcome.php"><p class="btnLink2">Back to Home</p></a>
        </div>
    </div>
        <hr>
    </div>
        
    <?php
    
        //Need to get family id for later insert query
        $username = $_SESSION["username"];
        $famID = $_SESSION["famID"];
        $initialPageOpen = $_SESSION['initialPageOpen'];
    
        $query = 'SELECT family_id, first_name, last_name, id FROM pb_children WHERE family_id=:famID';
        
        $statement = $db->prepare($query);

        // Now we bind the values to the placeholders. 
	    $statement->bindValue(':famID', $famID);

	    $statement->execute();
    
   
        echo "<h4>Enter the transactions one at a time.</h4>";
        
        if (isset($username) && $username != ""){
        
            $statement = $db->prepare("SELECT displayname, id, adult FROM pb_user WHERE username = :u");
        
            $statement->bindValue(':u', $username);
            $statement->execute();
    
            $row = $statement->fetch(PDO::FETCH_ASSOC);
        
            $displayName = $row['displayname'];
            $userID = $row['id'];
            $adult = $row['adult'];
            
            //if not adult user, child id needs to be set now.
            if($adult == true){
                
                $query = 'SELECT family_id, first_name, last_name, id FROM pb_children WHERE family_id=:famID';
        
                $statement = $db->prepare($query);

                // Now we bind the values to the placeholders. 
	           $statement->bindValue(':famID', $famID);
            
	           $statement->execute();
                
                
                echo "<form method='post'><label for='child' class='label'>Select the child the transaction pertains to: </label><select id='child' name='child' class='input')";  
    
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            
                $fName = $row['first_name'];
                $lName = $row['last_name'];
                $childID = $row['id'];
                echo "<option value='$childID'>$fName $lName</option>"; 
                }
                echo "</select><br><br>";
            }
        }
        if($adult != true) {

            $query = 'SELECT family_id, first_name, last_name, id FROM pb_children WHERE family_id=:famID AND first_name=:fName';
       
            $statement = $db->prepare($query);

            // Now we bind the values to the placeholders. 
	        $statement->bindValue(':famID', $famID);
            $statement->bindValue(':fName', $displayName);

	        $statement->execute();
            
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $childID = $row['id'];
            
            echo "<form method='post'>";
        }

        echo "<label for='type' class='label'>Choose the type of transaction:</label>
              <select id='type' name='type' class='input'>
              <option value='Earn'>Earn</option>
              <option value='Tithing'>Tithing</option>
              <option value='Save'>Save</option>
              <option value='Spend'>Spend</option>
              </select><br><br>";
    
        echo "<label for='amount' class='label'>Amount of transaction:  $</label> 
        <input type='text' name='amount' class='input1'><br><br>";
    
        echo "<label for='notes' class='label'>Notes: </label> 
        <input type='text' name='notes' class='input2'><br><br>";
    
        echo "<input type='submit' class='btnLink4'>";
    
        echo "</form>";
       
        // define variables and set to empty values
        $amount = $type = $child = $notes = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $test = true;  
        }
        else {
            $test = false;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["amount"])){
                $test = false;
                if(!$initialPageOpen){
                    echo "<p1>You did not enter an amount. Please re-enter the information including the amount.</p1>";
                    echo "<br>";
                }
            }
            else {
                $amount = htmlspecialchars($_POST["amount"]);
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["type"])){
                $type = htmlspecialchars($_POST["type"]);
            } 
    
            if(isset($_POST["child"])){
                $childID = htmlspecialchars($_POST["child"]);
            } 
    
            if(isset($_POST["notes"])){
                $notes = htmlspecialchars($_POST["notes"]);
            } 
        }
    
        //Turn initial page open to false so error messages will now work.
        $initialPageOpen = false;
        $_SESSION['initialPageOpen'] = $initialPageOpen;
        //If everything checks out, need to add record to database
        if($test == true){

            try
            {
            
                // Preparing the query to enter the account into the user db
	           $query = 'INSERT INTO pb_transactions(children_id, type_transaction, amount, notes) VALUES(:childID, :type, :amount, :notes)';
	           $statement = $db->prepare($query);

	           // Now we bind the values to the placeholders. This does some nice things
	           // including sanitizing the input with regard to sql commands.
	           $statement->bindValue(':childID', $childID);
	           $statement->bindValue(':type', $type);
	           $statement->bindValue(':amount', $amount);
               $statement->bindValue(':notes', $notes);
            

	           $statement->execute();
                
               echo "<p2>You've entered " . $type . ' $' . $amount . "</p2><br>";
            
            }
                catch (Exception $ex)
                {
	               // Please be aware that you don't want to output the Exception message in
	               // a production environment
	               echo "Error with DB. Details: $ex";
	               die();
                }
        
            echo "<a href='piggyBankAppWelcome.php'><p2>If you're done, return to the homepage.</p2></a>";
    }
   
    ?>
    
    
</body>
    
</html>