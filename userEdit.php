<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Restaurant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id ="adminPanel">

        <?php
            include('res/elements/header.php');

            include('res/elements/footer.php');

            include('functions/functions.php');

            userEdit();
        ?>
        <a href="userPanel.php">back to User Panel</a>
    </body>
</html>