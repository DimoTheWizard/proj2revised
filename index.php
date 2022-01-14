<?php
        session_start();
?>
<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id="mainPage">
        <?php
            include('res/elements/header.php');
        ?>

        <h1 class="homePage">
            Falconers Hotel and Restaurant
        </h1>
        <div id="mainPageBox">
            <div id="mainPageTopBox">
                <a class="mainPageBoxText mainPageBoxTextHover" href="reserve_rooms.php"><h3>Reserve Rooms</h3></a>
                <a class="mainPageBoxText mainPageBoxTextHover" href="activities.php"><h3>Reserve Activities</h3></a>
                <a class="mainPageBoxText mainPageBoxTextHover" href="reserve_tables.php"><h3>Reserve Tables</h3></a>
            </div>
            <div id="mainPageBotBox">
                <h1 class="mainPageBotBoxText"><a href="room.php" style="text-decoration:none; color:white;">Preview Rooms&emsp;</a><a href="RevTable.php" style="text-decoration:none; color:white;">&emsp;Preview Tables</a></h1>
            </div>
        </div>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>
