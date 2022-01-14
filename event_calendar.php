<?php
        session_start();
?>
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
            include('functions/functions.php');
        ?>
        <h1 id="evCalTitle">Monthly Events - December</h1>

        <table id="evCalEventTable">
            <tr>
                <th id="evCalTopRowTable">Event</th>
                <th id="evCalTopRowTable">Event Description</th>
                <th id="evCalTopRowTable">Date</th>
                <th id="evCalTopRowTable">Time</th>
            </tr>
                <?php
                    calendar();
                ?>
        </table>
        <p class="evCalText">
            Want to sign-up for an event?
        </p>
        <a class="evCalLink" href="activities.php">Click Here!</a>
        <?php
            include('res/elements/footer.php');
        ?>
    </body>
</html>