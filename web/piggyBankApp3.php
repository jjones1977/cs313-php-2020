<?php
// Start the session
session_start();
?>

<html>
    
<head>
    <title>Transactions</title>
    <link rel="stylesheet" type="text/css" href="style2.css">  
    
        <style>
    .div1 {
    margin-left: 50px;
    margin-top: 50px;
    font-family: Helvetica, Arial;
    font-size: 60pt;
}

        
.div2 {
    margin-top: 100px;
    margin-left: 125px;
}

.div3 {
 	width: 100px;
	height: 100px;
	
	position: absolute;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
  	
	margin: auto;
    
    font-family: Helvetica, Arial;
    font-size: 50pt;
}

.div4 {
    font-family: Helvetica, Arial;
    font-size: 20pt;
    flex-wrap: wrap;
    float: center;
}

.p2 {
    font-family: Helvetica, Arial;
    font-size: 30pt;
}

.p3 {
    font-family: Helvetica, Arial;
    font-size: 20pt;
}

.p4 {
    font-family: Helvetica, Arial;
    font-size: 25pt;
}

#btn1 {
    padding: 15pt;
    margin: 10pt;
    color: chocolate;
    background-color: chocolate;
    font-size: 20pt; 
    flex-wrap: wrap;
}

.btnLink2 {
    font-family: helvetica, arial; 
    font-size: 20pt;
    background-color: chocolate;
    color: white;
    float: right;
    padding-right: 10pt;
    padding-left: 10pt;           
}

.imgLogo {
    border-radius: 50%;
    width: 20px;
    height: auto;
}

.hLogo {
    font-family: fantasy, cursive;
    font-size: 200pt;
   }

h2 {
    font-family: fantasy, cursive;
    font-size: 50pt;
    margin-top: 10px;
    margin-bottom: 10px;
   }

.column {
    float: left;
   
    padding: 5px;
}
        
.column2 {
    float: right;
    
    padding: 5px;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

.p3 {
    font-family: fantasy, cursive;
    font-size: 100pt;
    float: right;
    }

    
</style>
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
    
    <div>
    <div class="row">
        <div class="column">
            <img src="bank.JPEG" alt="Logo">
        </div>
        <div class="column">
            <h2>Bankon</h2>
        </div>
        <div class="column2">
            <a href="piggyBankApp.php"><p class="btnLink2">Back to Home</p></a>
        </div>
    </div>
        <hr>
    </div>

    
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