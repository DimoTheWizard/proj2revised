<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="res/style.css">
    <title>Falcon Hotel and Resturant</title>
    <meta charset="utf-8">
    <meta lang="en-us">
</head>
<body id ="adminPanel">

<?php
include('res/elements/header.php');
?>

<?php
include('res/elements/footer.php');
?>

<?php
include('functions/functions.php');
?>

        <?php
        chooseEditFunction($_GET['funcRequired'], $_GET["id"]);
        ?>

    <input type = "submit" name = "submit" value = "Sign Out" class = "signout">
    <a href="adminPanel.php">back to Admin Panel</a>
</body>
</html>