<?php
    require("DBCon.php");
    session_start();
?>

<html>
    
<head>
    <title>Add a user</title>
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
        // define variables and set to empty values
        $username = $password = $password2 = $displayname = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $test = true;  
        }
        else {
            $test = false;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["addUsername"])){
                $test = false;
                echo "<p1>Please enter a username.</p1>";
                echo "<br>";
            }
            else {
                $username = htmlspecialchars($_POST["addUsername"]);
                $_SESSION["username"] = $username;
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["addPassword"])){
                $test = false;
                echo "<p1>Please enter a password.</p1>";
                echo "<br>";
            }
            else {
                $password = htmlspecialchars($_POST["addPassword"]);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $_SESSION["password"] = $password;
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["addPassword2"])){
                $test = false;
                echo "<p1>Please retype the password.</p1>";
                echo "<br>";
            }
            else {
                $password2 = htmlspecialchars($_POST["addPassword2"]); 
                
                if($password != $password2){
                    echo "<p1>Passwords did not match. Please re-enter the information.</p1>";
                    echo "<br>";
                    $test = false;
                }
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["addDisplayName"])){
                $test = false;
                echo "<p1>Please enter a given name.</p1>";
                echo "<br>";
            }
            else {
                $displayname = htmlspecialchars($_POST["addDisplayName"]);   
            }  
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["addSurname"])){
                $test = false;
                echo "<p1>Please enter a family username.</p1>";
                echo "<br>";
            }
            else {
                $surname = htmlspecialchars($_POST["addSurname"]);  
                
                //pull id from pb_family table OR create new entry
                //in pb_family table.
                try
                {
                    //Need to check if there is already a family username 
                    $query = 'SELECT surname, id FROM pb_family WHERE surname=:surname';
        
                    $statement = $db->prepare($query);

                    // Now we bind the values to the placeholders. 
	                $statement->bindValue(':surname', $surname);

	                $statement->execute();
            
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
                    $famID = $row['id'];
                    $_SESSION["famID"] = $famID;
                    
                    if(empty($famID)){
                        //If there is no family id already, make one
                        // Preparing the query to enter the account into the user db
	                   $query = 'INSERT INTO pb_family(surname) VALUES(:surname)';
                        
	                   $statement = $db->prepare($query);

                       // Now we bind the values to the placeholders. 
	                   $statement->bindValue(':surname', $surname);	       

	                   $statement->execute();
                        
                        //Now get family id for use later
                        $query = 'SELECT surname, id FROM pb_family WHERE surname=:surname';
        
                        $statement = $db->prepare($query);

                        // Now we bind the values to the placeholders. 
	                    $statement->bindValue(':surname', $surname);

	                    $statement->execute();
            
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
                        $famID = $row['id'];
                        $_SESSION["famID"] = $famID;
            
                    }    
                    
                }
                    catch (Exception $ex)
                {
	            // Please be aware that you don't want to output the Exception message in
	            // a production environment
	               echo "Error with DB. Details: $ex";
	               die();
                }
                
            }
    
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["childBox"])){
                $adult = 'f';
               
                //check to see if entry in pb_children. If not, make one
                $query = 'SELECT family_id, first_name, id FROM pb_children WHERE family_id=:famID AND first_name=:fName';
         
                $statement = $db->prepare($query);

                // Now we bind the values to the placeholders. 
	            $statement->bindValue(':famID', $famID);
                $statement->bindValue(':fName', $displayname);

	            $statement->execute();  
                $row = $statement->fetch(PDO::FETCH_ASSOC);
    
                $childID = $row['id'];
                
                if(empty($childID)){
                    //if no entry in pb_children exists, make one.
                    $query = 'INSERT INTO pb_children(family_id, first_name) VALUES(:famID, :fName)';
                        
	                $statement = $db->prepare($query);
              
                    // Now we bind the values to the placeholders. 
	                $statement->bindValue(':famID', $famID);
                    $statement->bindValue(':fName', $displayname);
    
	                $statement->execute();
 
                }
            }
            else{
                $adult = true;
            }
        }
    }  

    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h4>Please enter login information: </h4>
        <label for="addUsername" class="label">Username: </label> 
        <input type="text" name="addUsername" id="textAddUsername" value="<?php echo $username;?>" class="input5"><br><br>
        <label for="addPassword" class="label">Password: </label>
        <input type="password" name="addPassword" id="textAddPassword" value="<?php echo $password;?>" class="input4"><br><br>
        <label for="addPassword2" class="label">Retype password: </label>
        <input type="password" name="addPassword2" id="textAddPassword2" value="<?php echo $password2;?>" class="input"><br><br>
        <label for="addDisplayName" class="label">Given name: </label>
        <input type="text" name="addDisplayName" id="textAddDisplayName" value="<?php echo $displayname;?>" class="input6"><br><br>
        <label for="addSurname" class="label">family username - The account will be grouped under this name: </label>
        <input type="text" name="addSurname" id="textAddSurname" value="<?php echo $surname;?>" class="input"><br><br>
        <label for="childBox" class="label">Child</label>
        <input type="checkbox" name="childBox" id="childBox" value="<?php if(isset($_POST["childBox"])) echo 'checked';?>"><br><br>
        
        <input type="submit" class="btnLink4" id="AddUserSubmit" value="Create User">
    </form>
    
<?php
    
    //if everything checks out and test is still true, 
    //enter new user into db.
    if($test){
        try
        {
            
           // Preparing the query to enter the account into the user db
	       $query = 'INSERT INTO pb_user(password, username, displayname, adult, familyid) VALUES(:password, :username, :displayname, :adult, :familyid)';
	       $statement = $db->prepare($query);

	       // Now we bind the values to the placeholders. This does some nice things
	       // including sanitizing the input with regard to sql commands.
	       $statement->bindValue(':password', $passwordHash);
	       $statement->bindValue(':username', $username);
	       $statement->bindValue(':displayname', $displayname);
           $statement->bindValue(':adult', $adult);
           $statement->bindValue(':familyid', $famID);
            

	       $statement->execute();
            
        }
            catch (Exception $ex)
           {
	           // Please be aware that you don't want to output the Exception message in
	           // a production environment
	           echo "Error with DB. Details: $ex";
	           die();
           }
        
        echo "<h5>Your account has been successfully created.</h5>";
        echo "<a href='piggyBankAppWelcome.php'><p2>Return to login page.</p2></a>";
    }
   
?>
    
</body>
</html>