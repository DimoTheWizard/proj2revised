<?php
    session_start();
    require 'functions/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id ="admin">

    <!--User panel page-->

    <?php
        include('res/elements/header.php');
    ?>

    <?php
        include('res/elements/footer.php');
    ?>

    <form method = "post">
        <h1 class = "Tabletitle" > User Panel </h1>
        <table border="1" id="UserPanel">
            <tr>
                <th> Email    </th>
                <th> Username </th>
                <th> First Name </th>
                <th> Last Name </th>
                <th> User level  </th>
                <th> Edit  </th>
            </tr>
            <tr>
                    <?php overviewUser(); ?>
            </tr>
        </table>
    </form>
        <a href="functions/sessionDestroy.php">Logout</a>
    </body>
</html>
