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
