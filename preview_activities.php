<!DOCTYPE html>
<html>
    <head>
        <?php session_start(); ?>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id="preActBg">
        <?php
            include('res/elements/header.php');
        ?>
        <h1 id="preActTitle">Sign up for events</h1>
        <div id="preActPageBox">
            <div id="preActPageTopBox">
                <a class="preActPageBoxText preActPageBoxTextHover" href="event_calendar.php">Events calendar</a></h1>
                <a class="preActPageBoxText preActPageBoxTextHover" href="activities.php">Reserve a spot</a></h1>
            </div>
            <div id="preActPageBotBox">

            </div>
        </div>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>
