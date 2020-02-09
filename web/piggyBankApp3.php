<?php
// Start the session
session_start();
?>

<html>
    
<head>
    <title>Transactions</title>
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
    
   $childID = htmlspecialchars($_POST["id"]);
    
?>
    
<?php
    
    $statementGetChildName = $db->prepare('SELECT cTB.first_name AS fn, cTB.last_name AS ln, type_transaction AS t, amount AS a, tTB.notes AS n FROM pb_transactions as tTB JOIN pb_children AS cTB ON tTB.children_id = cTB.id WHERE cTB.id = :i');
    $statementGetChildName->bindValue(':i', $childID);
    $statementGetChildName->execute();
    
    $row = $statementGetChildName->fetch(PDO::FETCH_ASSOC);
        
    $childName = $row['fn'] . ' ' . $row['ln'];

?>

    <div class='div1'><?php echo $childName;?></div>

<div class="div2">   
<?php
    
    $statementTransactions = $db->prepare('SELECT cTB.first_name AS fn, cTB.last_name AS ln, type_transaction AS t, amount AS a, tTB.notes AS n FROM pb_transactions as tTB JOIN pb_children AS cTB ON tTB.children_id = cTB.id WHERE cTB.id = :i');
    $statementTransactions->bindValue(':i', $childID);
    $statementTransactions->execute();
    
    $total = 0;
    
    while ($row2 = $statementTransactions->fetch(PDO::FETCH_ASSOC))
    {
        $red = false;
        
        $trueAmount = $row2['a'];
        
        $type = $row2['t'];
        if ($type == 'spend' OR $type == 'tithing'){
            $amount = '-$' . $row2['a'];
            $red = true;
        }
        else {
            $amount = '$' . $row2['a'];
        }
        $notes = $row2['n'];

        if ($red) {
            echo "<p class='p4' style='color:red'>$type: $amount : $notes<p>";
        }
        else {
            echo "<p class='p4'>$type: $amount : $notes<p>";
        }
        
        if ($red){
            $total = $total - $trueAmount;    
        }
        if (!$red){
            $total = $total + $trueAmount;
        }
    } 
    
    $total2 = number_format((float)$total, 2, '.', '');
    echo "<p class='p4'>Total: $$total2<p>";
?>
</div>

            
</body>
</html>