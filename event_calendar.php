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
        <h1 id="evCalTitle">Monthly Events - December</h1>

        <table id="evCalEventTable">
            <tr>
                <th id="evCalTopRowTable">Event</th>
                <th id="evCalTopRowTable">Event Description</th>
                <th id="evCalTopRowTable">Date</th>
                <th id="evCalTopRowTable">Time</th>
            </tr>
            <tr>
                <td>River Kayaking</td>
                <td>Go kayaking in the calm river nearby the hotel</td>
                <td>4 Dec</td>
                <td>9 AM to 2 PM</td>
            </tr>
            <tr>
                <td>Pizza Making</td>
                <td>Kids can make their own pizza in the restaurant</td>
                <td>7 Dec</td>
                <td>1 PM to 3 PM</td>
            </tr>
            <tr>
                <td>Falcon Show</td>
                <td>Watch trained proffesionals demonstrate tricks with the falcons</td>
                <td>10 Dec</td>
                <td>11 AM to 1 PM</td>
            </tr>
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