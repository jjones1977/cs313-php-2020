<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="display.php" method="post">
        <label>Name</label>
        <input type="text" name="name" id="name"><br>
        <label>Email</label>
        <input type="text" name="email" id="email"><br>
        <label>Major</label><br>
        <!--stretch code 1-->
        <?php //script for major inputs
        $major = array("Computer Science","Web Design and Development", "Computer Information Technology");
        foreach($major as $each){
            echo "<input type='radio' name='major' value=$each>$each <br>";
        }
        ?>
        <!--original code-->
        <!-- <input type="radio" name="major" value="Computer Science" >Computer Science<br>
        <input type="radio" name="major" value="Web Design and Development">Web Design and Development<br>
        <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br> -->
        <label>Comments</label>
        <textarea name="comments"></textarea><br>
        <label>Places visited: </label>
        
        <input type="checkbox" value="North America" name="country1">North America<br>
        <input type="checkbox" value="South America" name="country2">South America<br>
        <input type="checkbox" value="Europe" name="country3" >Europe<br>
        <input type="checkbox" value="Asia" name="country4" >Asia<br> 
        <input type="checkbox" value="Australia" name="country5" >Australia"<br> 
        <input type="checkbox" value="Africa" name="country6" >Africa<br> 
        <input type="checkbox" value="Antarctica" name="country7" > Antarctica<br> 
        <input type="submit" value="Submit">
    
    </form>
</body>
</html>