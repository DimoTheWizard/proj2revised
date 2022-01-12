<?php
/*
    Name: Arian Atapour
    Student code: 5088453
 */

require 'functions.php';
edit();


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Bug Reporter</title>
</head>
<body>
<h1>Edit bug</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <input type="text" name="productName"> Product<br><br>
    <input type="text" name="version"> Version<br><br>
    <input type="text" name="hwType"> Hardware<br><br>
    <input type="text" name="os"> Version<br><br>
    <input type="text" name="frequency"> Frequency<br><br>
    <input type="text" name="solution"> Solution<br><br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
