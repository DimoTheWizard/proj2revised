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
    <body id ="admin">

    <!--User panel page-->

    <?php
        include('res/elements/header.php');
    ?>

    <?php
        include('res/elements/footer.php');
    ?>

    <h1 class = "Tabletitle" > User Panel </h1>
        <table border="1" id="UserPanel">
            <tr>
                <th> Email    </th>
                <th> Username </th>
                <th> First Name </th>
                <th> Last Name </th>
                <th> User level  </th>
                <th> Is certificate uploaded ?  </th>
                <th> Edit  </th>
            </tr>
            <tr>
                    <?php overviewUser(); ?>
            </tr>
        </table>

    <div id="UserPanel">
    <h1 class = "Tabletitle"> Covid Certificate Upload </h1>
        <h4>Please upload only PDF and under 3MB</h4>
        <br>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="certFile"><br><br>
            <input type="submit" class="submitCert" value="Upload covid certificate" style="background-color:#008c2ac4; padding:3px;">
            <?php covCert(); ?>
        </form>
    </div>
    </body>
</html>
