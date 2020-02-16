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
    
#btn2 {
    padding: 5pt;
    margin-top: 10pt;
    color: white;
    background-color: chocolate;
    font-size: 20pt;
}
    
</style>
    
    
<script>
    function test() {
        document.getElementById("demo").innerHTML = "Hello World";
        document.getElementById("btn2").disabled = true;
    }
    
    function test2() {
        document.getElementById("demo").innerHTML = "Good Bye";
    }

    function validatePassword () {
        if (document.getElementById("textPassword")==""){
            document.getElementById("btn2").disabled = true;
            document.getElementById("usernameError").visible = true;
        }
    }
    
    function setPasswordToEmpty(){
        document.getElementById("textPassword").innerHTML = "";
        document.getElementById("textUsername").innerHTML = "";
        document.getElementById("usernameError").visible = false;
        document.getElementById("usernamePasswordError").visible = false;
        document.getElementById("btn2").disabled = false;
    }
    
    function passwordError() {
        document.getElementById("usernamePasswordError").visible = true;
        document.getElementById("btn2").disabled = true;
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
    
<?php
    
        if (isset($_POST["first_name"])){
            $surname = htmlspecialchars($_POST["first_name"]);
        }
        if (isset($_POST["last_name"])){
            $username = htmlspecialchars($_POST["last_name"]);
        }
        if (isset($_POST["age"])){
            $password = htmlspecialchars($_POST["age"]);
        }
        if (isset($_POST["notes"])){
            $password = htmlspecialchars($_POST["notes"]);
        }
    
    try
{
	// Add the Scripture

	// We do this by preparing the query with placeholder values
    if (isset($surname, $username, $password)){
	   $query = 'INSERT INTO pb_family(surname, password, username) VALUES(:surname, :password, :username)';
	   $statement = $db->prepare($query);

	   // Now we bind the values to the placeholders. This does some nice things
	   // including sanitizing the input with regard to sql commands.
	   $statement->bindValue(':surname', $surname);
	   $statement->bindValue(':password', $password);
	   $statement->bindValue(':username', $username);

       $statement->execute();
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

    <div>
    <div class="row">
        <div class="column"><img src="bank.JPEG" alt="Logo"></div>
        <div class="column"><h2>Bankon</h2></div>
    </div>
        <hr>
    </div>

    
    <div class = "div3">
        <!-- <p id="usernameError" class="p4">Please enter a username.</p>
        <p id="usernamePasswordError" class="p4">Password does not match username.</p>-->
    <form  action = "piggyBankApp2.php" method="post">
        <label for="username">Username: </label> 
        <input type="text" name="username" id="textUsername"><br>
        <label for="password">Password: </label>
        <input type="text" name="password" id="textPassword"><br>
        <input type="submit" id="btn2" id="loginSubmit">
    </form>
        
        <p id="demo"></p>
        <a href="piggyBankAppAddUser.php">Not a member?</a>
    </div>


    
    
</body>
</html>