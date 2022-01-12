
<?php session_start(); ?>

<?php require 'functions/functions.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Reserve a room</title>
    </head>
    <body id="resRoomBG">
    <?php
            include('res/elements/header.php');
    ?>
        <h1 id="resRoomTitle">Reserve a room</h1>
        <?php reserveRoomSuccess(); ?>
        <br>
    <table border="1" id="resRoomTable">

        <tr>
            <th>Room Name</th>
            <th>Quantity</th>
            <th>Reserve</th>
        </tr>

        <?php reserveRoom(); ?>


    </table>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>
