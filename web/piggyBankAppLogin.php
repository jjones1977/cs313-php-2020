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
    </div>
        <hr>
    </div>
    
    <?php
    
        // define variables and set to empty values
        $username = $password = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $test = true;  
        }
        else {
            $test = false;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["username"])){
                $test = false;
                echo "<p1>Please enter a username.</p1>";
                echo "<br>";
            }
            else {
                $username = htmlspecialchars($_POST["username"]);
                $_SESSION["username"] = $username;
                
                //get hashed password from database
                try
                {

	               // Preparing the query with placeholder values
	               $query = "SELECT username, password, id FROM pb_user WHERE username = :username";
                   
	               $statement = $db->prepare($query);

	               // Now we bind the values to the placeholders.
	               $statement->bindValue(':username', $username);        

	               $statement->execute();
                    
                   $row = $statement->fetch(PDO::FETCH_ASSOC);
        
                   $passwordDB = $row['password'];
            
                }
                    catch (Exception $ex)
                {
	               // Please be aware that you don't want to output the Exception message in
	               // a production environment
	               echo "Error with DB. Details: $ex";
	               die();
                }
        
                
            }  
        }
    
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["password"])){
                $test = false;
                echo "<p1>Please enter a password.</p1>";
                echo "<br>";
            }
            else {
                //get password from form
                $password = htmlspecialchars($_POST["password"]);
                $_SESSION['password'] = $password;
                
                if (password_verify($password, $passwordDB)) {
                    header('Location: '.'piggyBankAppWelcome.php');
                } else {
                    $test = false;
                    echo "<p1>You've entered the wrong password. Please try again.</p1>";
                }
            }  
        }
    ?>
    
    <div>
        <form method="post" >
            <label for="username" class="label">Username: </label> 
            <input type="text" name="username" id="textUsername" class="input"><br><br>
            <label for="password" class = "label">Password: </label>
            <input type="password" name="password" id="textPassword" class="input3"><br><br>
            <input type="submit" id="btn2" id="loginSubmit" class="btnLink4">
        </form>
        
        <a href="piggyBankAppAddUser.php"><p class="label">Not a member?</p></a>
    </div>
        
</body>
    
</html>