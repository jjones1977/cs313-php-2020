<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Confirmed</title>
        <link rel="stylesheet" type="text/css" href="Week3Prove.css">
    
        
    <style>
            p {
            
            }
            img {
                border-radius: 50%;
                width: 125px;
                height: auto;
            }
            
            .div1 {
                flex-wrap: wrap;
                padding-top: 10pt;
                float: left;
            }
            .div2 {
                flex-wrap: wrap;
                margin-left: 175pt;
            }
            
            .div3 {
                flex-wrap: wrap;
                float: right;
                margin-right: 150px;
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .div4 {
                flex-wrap: wrap;
                padding-top: 10pt;
            }
            
            .div5 {
                float: left;
            
            }
            
            .div6 {
                flex-wrap: nowrap;
                padding-top: 75pt;
                float: right;
            }
            
            .div7 {
                float: right;
                flex-wrap: nowrap;
            }
            
            .divRow {
                display: flex;
                flex-wrap: wrap;
                margin-top; 0px;
            }
            
            h1 {
                font-family: fantasy, cursive;
                font-size: 50pt;
                text-align: center;
            }
            
            h2 {
                font-family: fantasy, cursive;
                font-size: 20pt;
                
            }
            
            h3 {
                font-family: fantasy, cursive;
                font-size: 30pt;
                padding-top: 25pt;
                margin-bottom: 0pt;
                
            }
            
            h4 {
                font-family: fantasy, cursive;
                font-size: 20pt;
                padding-top: 25pt;
                margin-bottom: 0pt;
                
            }
                    
            h5 {
                font-family: fantasy, cursive;
                font-size: 30pt;
                margin-bottom: 0pt;
                
            }
                    
                    
            
            body {
                background-color: blanchedalmond;
            }
            
            .btnLink {
                font-family: helvetica, arial; 
                font-size: 20pt;
               
                color: coral;
            }
            
           .btnLink2 {
                font-family: helvetica, arial; 
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: right;
                padding-right: 10pt;
                padding-left: 10pt;
            
            }
            
            .btnLink3 {
                font-family: helvetica, arial; 
                font-size: 20pt;
                background-color: chocolate;
                color: white;
                float: right;
                padding-right: 10pt;
                padding-left: 10pt;
                border-radius: 20%;
            }
            
            .btnLink4 {
                font-family: helvetica, arial; 
                font-size: 15pt;
                color: coral;
                float: right;
            }
            
            
            .chLabel {
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .addressLabel {
                font-family: Helvetica, Arial;
                font-size: 15pt;
            }
            
            .p1 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
                margin-top: 0pt;
            }
            
            .p2 {
                font-family: Helvetica, Arial;
                font-size: 30pt;
                margin-top: 10pt;
                
            }
            
            .p3 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
                padding-top: 45pt;
                padding-left: 175pt;
                float: right;
            }
            
            .p4 {
                font-family: Helvetica, Arial;
                font-size: 15pt;
            }
            
            .p5 {
                font-family: Helvetica, Arial;
                font-size: 20pt;
            }
            
            .btnSubmit {
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: right;
            }
            
            .btnSubmit2 {
                font-size: 20pt;
                background-color: coral;
                color: white;
                float: left;
                padding-right: 10pt;
                padding-left: 10pt;
            }
        </style>
    </head>
    <body>
        <h1>The Chocolate Store</h1><hr>

        <?php
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();

            echo "<p class='p1'>Congratulations! You've completed your chocolate order. Yummy deliciousness will ship in the next 2-3 business days.</p>";
        
        ?>
        
        <a href="Week03Prove.php" class="btnLink"><p>Would you like to continue shopping?</p></a>

    </body>
</html>