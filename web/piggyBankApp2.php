<?php
// Start the session
session_start();
?>

<html>
    
<head>
    <title>Select Family Member</title>
    <link rel="stylesheet" type="text/css" href="style2.css">       
</head>
    
<body>
<?php   
try
{
  $user = 'ydnqgenybblmcs';
  $password = '1fddb6c8034d2361a90e2535b8226b9d3931b3d343d26320190ae2e90fcc863f';
  $db = new PDO('pgsql:host=ec2-52-71-122-102.compute-1.amazonaws.com;dbname=dbb5pi03k8rheg', $user, $password);

  // this line makes PDO give us an exception when there are problems,
  // and can be very helpful in debugging! (But you would likely want
  // to disable it for production environments.)
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
    
?>

    <a href="piggyBankApp.php"><p class="btnLink2">Back to Home</p></a>
    
<?php
   $username = htmlspecialchars($_POST["username"]);
   $password = htmlspecialchars($_POST["password"]);  
    

    $statementSurname = $db->prepare('SELECT id, surname FROM pb_family WHERE pb_family.username = :u');
    $statementSurname->bindValue(':u', $username);
    $statementSurname->execute();
    
    $surnameRow = $statementSurname->fetch(PDO::FETCH_ASSOC);
    $surname2 = $surnameRow['surname'];
    
    //Need to save family id to session
    $surnameID = $surnameRow['id'];
    $_SESSION["familyID"] = $surnameID;
    
?>
    <div class='div1'><?php echo $surname2 . ' Family'; ?></div>

<div class='div2'>
<?php
    
    $statementFamily = $db->prepare('SELECT cTB.id AS id, first_name AS f, last_name AS l FROM pb_children AS cTB JOIN pb_family AS fTB ON cTB.family_id = fTB.id WHERE fTB.id = :i');
    $statementFamily->bindValue(':i', $surnameID);
    $statementFamily->execute();
    
    echo "<p class='p2'>Please click the button next to the family member of your choice to enter and view transactions.<p>";
    
    while ($row = $statementFamily->fetch(PDO::FETCH_ASSOC))
    {
        $id = $row['id'];
        $fName = $row['f'];
        $lName = $row['l'];

        echo 
        '<form name="X" action="piggyBankApp3.php" method="POST">
             
             <input id="btn1" type="submit" name="id" value=' . $id. '>
             <label for="id" class="p2"><strong>  ' . $fName . ' ' . $lName . '</strong></label>
        </form>';
       
        
      
    }
    ?>

</div>
    
</body>
</html>