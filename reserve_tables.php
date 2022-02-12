<?php 
    session_start();
    require 'functions/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Restaurant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id="resTableBg">

    <!--Reservation page for tables-->

        <?php
            include('res/elements/header.php');
        ?>
        <h1 id="resTableTitle">
            Reserve Tables
        </h1>
        <div id="resTableBox">
            <form id="resTableForm" method="post">
                <label class="resTableTextspacing"for="tableList">Table Number:</label><br>
                <select name="tableList" class="reserveTablesFormInput">
                    <?php
                        dropDownTable();
                    ?>
                </select>
                <input type="submit" value="Reserve!" name="submit" class="reservetablebutton reservetablebuttonhover">
                <?php
                    tableReservation(); 
                ?>
            </form>
        </div>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>