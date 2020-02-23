<?php
// Start the session
session_start();
?>

<html>
    
<head>
    <title>View Transactions</title>
    <link rel="stylesheet" type="text/css" href="style2.css">  
</head>
    
<body>
<?php
    require("DBCon.php");
    $initialPageOpen = true;
    $_SESSION['initialPageOpen'] = $initialPageOpen;
?>
    
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
  
        if (isset($username) && $username != ""){
        
            $statement = $db->prepare("SELECT displayname, id, adult FROM pb_user WHERE username = :u");
        
            $statement->bindValue(':u', $username);
            $statement->execute();
    
            $row = $statement->fetch(PDO::FETCH_ASSOC);
        
            $displayName = $row['displayname'];
            $userID = $row['id'];
            $adult = $row['adult'];
            
            //adult user, add option to select child
            if($adult == true){
                
                $query = 'SELECT family_id, first_name, last_name, id FROM pb_children WHERE family_id=:famID';
        
                $statement = $db->prepare($query);

                // Now we bind the values to the placeholders. 
	           $statement->bindValue(':famID', $famID);

	           $statement->execute();
        
                echo "<h4>Select the child and type of report.</h4>";
                //get list of kids from dropdown
                echo "<form method='post'><label for='child' class='label'>Select the child the transaction pertains to: </label><select id='child' name='child' class='input')";  
    
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            
                    $fName = $row['first_name'];
                    $lName = $row['last_name'];
                    $childID = $row['id'];
                    echo "<option value='$childID'>$fName $lName</option>"; 
            }
            echo "</select><br><br>";
            }
            else{
                //if not adult user, child id needs to be set now.
                $query = 'SELECT family_id, first_name, last_name, id FROM pb_children WHERE family_id=:famID AND first_name=:fName';
       
                $statement = $db->prepare($query);

                // Now we bind the values to the placeholders. 
	            $statement->bindValue(':famID', $famID);
                $statement->bindValue(':fName', $displayName);

	            $statement->execute();
            
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $childID = $row['id'];
                
                echo $fName . "<br>";
                echo "<form method='post'>";
            }
        }
    
    
    
    //show type of report options to kids and adults both
    
        echo "<label for='type' class='label'>Choose the type of transaction:</label>
              <select id='type' name='type' class='input'>
              <option value='All'>All</option>
              <option value='Earn'>Earn</option>
              <option value='Tithing'>Tithing</option>
              <option value='Save'>Save</option>
              <option value='Spend'>Spend</option>
              </select><br><br>";

        echo "<input type='submit' value='Get Report' class='btnLink4'>";
    
        echo "</form>";
        

?>

    <div class='div1'><?php echo $childName;?></div>

<div class="div2">   
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["child"])){
           $childID = htmlspecialchars($_POST["child"]);
        }
        
        if(isset($_POST["type"])){
           $type = htmlspecialchars($_POST["type"]);
        }
    }
    
    if(isset($type)){
        if($type == "All"){
            
            $statement = $db->prepare('SELECT cTB.first_name AS fn, cTB.last_name AS ln, type_transaction AS t, amount AS a, tTB.notes AS n FROM pb_transactions as tTB JOIN pb_children AS cTB ON tTB.children_id = cTB.id WHERE cTB.id = :childID');
            
            $statement->bindValue(':childID', $childID);
            
            $statement->execute();
        }
        else {
        
            $statement = $db->prepare("SELECT cTB.first_name AS fn, cTB.last_name AS ln, type_transaction AS t, amount AS a, tTB.notes AS n FROM pb_transactions as tTB JOIN pb_children AS cTB ON tTB.children_id = cTB.id WHERE cTB.id = :childID AND tTB.type_transaction = :type");
            
            $statement->bindValue(':childID', $childID);
            $statement->bindValue(':type', $type);
            
            $statement->execute();
        }
        
    }
    
    //Get child's name
    $statementChild = $db->prepare('SELECT first_name, last_name FROM pb_children WHERE id = :childID');
            
    $statementChild->bindValue(':childID', $childID);
            
    $statementChild->execute();
    
    $rowChild = $statementChild->fetch(PDO::FETCH_ASSOC);
    
    $childName = $rowChild['first_name'];
    
    if ($initialPageOpen){
        $initialPageOpen = false;
    }
    else {
        echo "<h4>Records for $childName</h4>";     
    }
    $total = 0;
    
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $red = false;
        
        $trueAmount = $row['a'];
        
        $type = $row['t'];
        if ($type == 'Spend' OR $type == 'Tithing'){
            $amount = '-$' . $row['a'];
            $red = true;
        }
        else {
            $amount = '$' . $row['a'];
        }
        $notes = $row['n'];

        if ($red) {
            echo "<p class='p4' style='color:red'>$type: $amount  $notes<p>";
        }
        else {
            echo "<p class='p4'>$type: $amount  $notes<p>";
        }
        
        if ($red){
            $total = $total - $trueAmount;    
        }
        if (!$red){
            $total = $total + $trueAmount;
        }
    } 
    
    if($total != 0){
        $total2 = number_format((float)$total, 2, '.', '');
        echo "<p class='p4'>Total: $$total2<p>";
    }
    else{
        echo "<h4>You do not have any records to display.</h4>";
    }
    
?>
</div>

            
</body>
</html>