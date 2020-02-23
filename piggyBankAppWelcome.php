<?php
    require("DBCon.php");
    session_start();
?>

<html>
    
<head>
    <title>Select Family Member</title>
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
            <a href="piggyBankAppLogin.php"><p class="btnLink2">Change User</p></a>
        </div>
    </div>
        <hr>
    </div>
    
    
<?php
    
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
    }

    if (isset($username) && $username != ""){
        
        $statement = $db->prepare("SELECT displayname, id, adult, familyid FROM pb_user WHERE username = :u");
        
        $statement->bindValue(':u', $username);
        $statement->execute();
    
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        $displayName = $row['displayname'];
        $userID = $row['id'];
        $adult = $row['adult'];
        $famID = $row['familyid'];
        
        
        //Need to save user id to session
        $_SESSION["userID"] = $userID;
        
        //Need to save family id to session
        $_SESSION["famID"] = $famID;
        
        //add whether user is adult or child to session
        $_SESSION["adult"] = $adult;
        
        
        //echo welcome to user
        echo "<div class='div4'><h3>Welcome $displayName</h2></div>";
  
        if($adult) {
            
            
            //echo all options
            //echo enter transactions
            echo '<form name="enterTransactions" action="piggyBankAppEnterTransactions.php" method="POST">
             
             <input id="btn1" type="submit" name="enterTran" value="enterTran">
             <label for="enterTran" class="p2"><strong>Enter transactions for your family.</strong></label>
        </form>';
            //echo print reports
            echo '<form name="viewReports" action="piggyBankAppViewReports.php" method="POST">
             
             <input id="btn1" type="submit" name="viewRept" value="viewRept">
             <label for="viewRept" class="p2"><strong>View reports for your family.</strong></label>
        </form>';
            //echo add child
            echo '<form name="createFamMemb" action="piggyBankAppAddChild.php" method="POST">
             
             <input id="btn1" type="submit" name="addChilld" value="addChilld">
             <label for="addChilld" class="p2"><strong>Add family members to Bankon.</strong></label>
        </form>';
        }
        if(!$adult) {
            //echo child appropriate options
            //echo enter transactions (just for that child)
            echo '<form name="enterTransactionsC" action="piggyBankAppEnterTransactions.php" method="POST">
             
             <input id="btn1" type="submit" name="enterTranC" value="enterTranC">
             <label for="enterTranC" class="p2"><strong>Enter transactions</strong></label>
        </form>';
            //echo print reports (just for that child)
            echo '<form name="viewReportsC" action="piggyBankAppViewReports.php" method="POST">
             
             <input id="btn1" type="submit" name="viewRepC" value="viewRepC">
             <label for="viewRepC" class="p2"><strong>View reports</strong></label>
        </form>';
        }
        
    }
    else {
        //Welcome to general
        echo "<div class='div7'><h3>Welcome to Bankon</h2>";
        
        //echo login link
        echo "<a href='piggyBankAppLogin.php'><div class='div8'><p class='btnLink3'>Login</p></div></a><br>";
        
        //echo create login link
        echo "<a href='piggyBankAppAddUser.php'><div class='div8'><p class='btnLink4'>Not Already a User?</p></div></a></div>";
        
       
    }
    
?>
    
</body>
    
</html>