<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id="resTableBg">
        <?php
            include('res/elements/header.php');
        ?>
        <h1 id="resTableTitle">
            Reserve Tables
        </h1>
        <div id="resTableBox">
        <form id="resTableForm">
            <label class="resTableTextspacing"for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname"><br><br>
            <label class="resTableTextspacing"for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br><br>
            <label class="resTableTextspacing"for="tableNumber">Table Number:</label><br>
            <input type="text" id="lname" name="lname">
            <input type="submit" value="Reserve!" name="reserve" class="reservetablebutton reservetablebuttonhover">
        </form>
        </div>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>
