<?php
// Start the session
session_start();
?>

<html>
    
<head>
    <title>Login Page</title>
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
	
	position: absolute;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
  	
	margin: auto;
    
    font-family: Helvetica, Arial;
    font-size: 30pt;
}

.div4 {
    font-family: Helvetica, Arial;
    font-size: 20pt;
    float: center;
    text-align: center;
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

.row {
  content: "";
  clear: both;
  display: table;
}

.p3 {
    font-family: fantasy, cursive;
    font-size: 100pt;
    float: right;
    }
    
    .p4 {
        color=red;
    }

input[type=text] {
  width: 140pt;
  padding: 10px 10px;
  box-sizing: border-box;
}
    
.btn2 {
    padding: 5pt;
    margin-top: 10pt;
    color: white;
    background-color: chocolate;
    font-size: 20pt;
}
    
</style>
    
    
<script>

    validatePassword(){
        var password1 = document.getElementById("textAddPassword").innerHTML;
        var password2 = document.getElementById("textAddPasswordAgain").innerHTML;
        alert("Passwords do not match.");
        if(!(password1 == password2)) {
            alert("Passwords do not match.");
            document.getElementById("AddUserSubmit").disabled = true;
        }
        if(password1 == password2){
            document.getElementById("AddUserSubmit").disabled = false;
        }
        
        validatePassword2(){
            document.getElementById("test3").innerHTML = "test";
        }
        
        function test() {
        document.getElementById("demo").innerHTML = "Hello World";
    }
        
    }
    
</script>
    
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
    
    <form method="post">
        <label for="addSurname">Family Name: </label> 
        <input type="text" name="addSurname" id="textAddSurname"><br><br>
        <p>Please enter login information: </p>
        <label for="addUsername">Username: </label> 
        <input type="text" name="addUsername" id="textAddUsername"><br>
        <label for="addPassword">Password: </label>
        <input type="text" name="addPassword" id="textAddPassword"><br>
        
        <input type="submit" class="btn2" id="AddUserSubmit" value="Create User">
    </form>
    
<?php
        $surname = htmlspecialchars($_POST["addSurname"]);
        $username = htmlspecialchars($_POST["addUsername"]);
        $password = htmlspecialchars($_POST["addPassword"]);
    
    try
{
	// Add the Scripture

	// We do this by preparing the query with placeholder values
	$query = 'INSERT INTO pb_family(surname, password, username) VALUES(:surname, :password, :username)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':surname', $surname);
	$statement->bindValue(':password', $password);
	$statement->bindValue(':username', $username);

	$statement->execute();
    $query2 = 'SELECT id FROM pb_family WHERE pb_family.surname = :surname';
	$statement2 = $db->prepare($query2);
  
    $statement2->bindValue(':surname', $surname);
        
    $statement2->execute();
    
    
    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
    {
        $idFamily = $row2['id'];
      
    }   
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}
   
?>
    
        <br>
        <br>
    <form method="post">
        <p>Add your children one at a time.</p>
        <label for="childFN">First Name: </label> 
        <input type="text" name="childFN"><br>
        <label for="childLN">Last Name: </label> 
        <input type="text" name="childLN"><br>
        <label for="childAge">Age: </label> 
        <input type="text" name="childAge"><br>
        <label for="childNotes">Notes: </label> 
        <input type="text" name="childNotes"><br>
         
        
        <input type="submit" class="btn2" id="AddUserSubmit" value="Add Child">
    </form>

<?php
    
    
    if(isset($_POST["childFN"])){
        $firstName = htmlspecialchars($_POST["childFN"]);
    }
    if(isset($_POST["childLN"])){
        $lastName = htmlspecialchars($_POST["childLN"]);
    }
    if(isset($_POST["childAge"])){
        $age = htmlspecialchars($_POST["childAge"]);
    }
    if(isset($_POST["childNotes"])){
        $notes = htmlspecialchars($_POST["childNotes"]);
    }
/*    
    try
{
	// Add the Scripture

	// We do this by preparing the query with placeholder values
	$query3 = 'INSERT INTO pb_children (family_id, first_name, last_name, age, notes) VALUES(:family_id, :first_name, :last_name, :age, :notes)';
	$statement3 = $db->prepare($query3);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement3->bindValue(':family_id', $idFamily);
    $statement3->bindValue(':first_name', $firstName);
	$statement3->bindValue(':last_name', $lastName);
	$statement3->bindValue(':age', $age);
    $statement3->bindValue(':notes', $notes);

	$statement3->execute();
        
    $query4 = 'SELECT first_name, last_name FROM pb_children WHERE family_id = :family_id';
	$statement4 = $db->prepare($query4);
  
    $statement4->bindValue(':family_id', $idFamily);
        
    $statement4->execute();
    
    while ($row4 = $statement4->fetch(PDO::FETCH_ASSOC))
    {
        $firstName = $row4['first_name'];
      
    }   
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}*/
   
?>

    
</body>
</html>