<?php
echo "Name: " . $_POST["name"] . "<br>";
echo "Email: " . $_POST["email"]. "<br>";
echo "Major: " . $_POST["major"]. "<br>";
echo "Comments: " . $_POST["comments"]. "<br>";
echo "Countries Visited: <br>";
if(isset($_POST["country1"])){
    echo $_POST["country1"] . "<br>";
}
if(isset($_POST["country2"])){
    echo $_POST["country2"] . "<br>";
}
if(isset($_POST["country3"])){
    echo $_POST["country3"]. "<br>";
}
if(isset($_POST["country4"])){
    echo $_POST["country4"]. "<br>";
}
if(isset($_POST["country5"])){
    echo $_POST["country5"]. "<br>";
}
if(isset($_POST["country6"])){
    echo $_POST["country6"]. "<br>";
}
if(isset($_POST["country7"])){
    echo $_POST["country7"]. "<br>";
}
// foreach(i as $_POST){
//     if(isset($_POST[i]))
// }
?>