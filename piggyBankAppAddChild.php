<?php
    require("DBCon.php");
    session_start();
?>

<html>
    
<head>
    <title>Add Family Member</title>
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
    
        $query = 'SELECT first_name, last_name FROM pb_children WHERE family_id=:famID';
        
        $statement = $db->prepare($query);

        // Now we bind the values to the placeholders. 
	    $statement->bindValue(':famID', $famID);

	    $statement->execute();
        
        //show kids already entered
        echo "<h5>These are your children already in the database.</h5>";
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
          //  echo "<p>$row['first_name'] . ' ' . $row['last_name']</p>";
            echo '<p2>' . $row['first_name'] . ' ' . $row['last_name'] . "</p2><br>";
        }
    
        //put some space between kid list and error messages.
        echo "<br>";
    
  
        // define variables and set to empty values
        $fName = $lName = $age = $notes = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $test = true;  
        }
        else {
            $test = false;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["childFN"])){
                $test = false;
                echo "<p1>Please enter a first name.</p1>";
                echo "<br>";
            }
            else {
                $fName = htmlspecialchars($_POST["childFN"]);
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["childLN"])){
                $test = false;
                echo "<p1>Please enter a last name.</p1>";
                echo "<br>";
            }
            else {
                $lName = htmlspecialchars($_POST["childLN"]);
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["childAge"])){
                $test = false;
                echo "<p1>Please enter an age for your child.</p1>";
                echo "<br>";
            }
            else {
                $age = htmlspecialchars($_POST["childAge"]);
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["childNotes"])){
                //Don't need notes necessarily
            }
            else {
                $notes = htmlspecialchars($_POST["childNotes"]);
            }  
        }
    
    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h4>Add your children one at a time.</h4>
        <label for="childFN" class='label'>First Name: </label> 
        <input type="text" name="childFN" value="<?php echo $fName;?>" class='input'><br><br>
        <label for="childLN" class='label'>Last Name: </label> 
        <input type="text" name="childLN" value="<?php echo $lName;?>" class='input'><br><br>
        <label for="childAge" class='label'>Age: </label> 
        <input type="number" name="childAge" value="<?php echo $age;?>" class='input3'><br><br>
        <label for="childNotes" class='label'>Notes: </label> 
        <input type="text" name="childNotes" value="<?php echo $notes;?>" class='input4'><br><br>
         
        
        <input type="submit" id="AddUserSubmit" value="Add Child" class="btnLink4">
    </form>

   `<?php
        //Turn initial page open to false so error messages will now work.
        $initialPageOpen = false;
        $_SESSION['initialPageOpen'] = $initialPageOpen;    
    
        //If everything checks out, need to add record to database
        if($test){
            try
            {
            
                // Preparing the query to enter the account into the user db
	           $query = 'INSERT INTO pb_children(family_id, first_name, last_name, age, notes) VALUES(:famID, :fName, :lName, :age, :notes)';
	           $statement = $db->prepare($query);

	           // Now we bind the values to the placeholders. This does some nice things
	           // including sanitizing the input with regard to sql commands.
	           $statement->bindValue(':famID', $famID);
	           $statement->bindValue(':fName', $fName);
	           $statement->bindValue(':lName', $lName);
               $statement->bindValue(':age', $age);
               $statement->bindValue(':notes', $notes);
            

	           $statement->execute();
            
                //echo $fName . ' ' . $lName . "<br>";
                
            }
                catch (Exception $ex)
                {
	               // Please be aware that you don't want to output the Exception message in
	               // a production environment
	               echo "Error with DB. Details: $ex";
	               die();
                }
        
            echo "<p2>You've added " . $fName . " " . $lName . "</p2><br><br>";
            echo "<a href='piggyBankAppWelcome.php'><p2>If you're done, return to the homepage.</p2></a>";
    }

    ?>
    
    
</body>
    
</html>