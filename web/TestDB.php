<html>
<body>
<p>test</p>
<?php

/*try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}*/
    
try
{
  $user = 'yutwrmddpttczy';
  $password = '5486f1c23917adfbcbd7e8e53866868eac84a44066e3dc86422967b59b25c156';
  $db = new PDO('pgsql:host=ec2-52-203-98-126.compute-1.amazonaws.com;dbname=d9uj23grn5cdb8', $user, $password);

  // this line makes PDO give us an exception when there are problems,
  // and can be very helpful in debugging! (But you would likely want
  // to disable it for production environments.)
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'connection made';
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
    /*
    $message = '';
    $db = new mysqli('localhost', 'Jenni', 'Jennibug1977', 'TestDBLocal2');
    
    if ($db->connect_error){
        
        $message = $db->connect_error;
    }
    else{
        echo message;
    }
    }*/
?>

</body>
</html>