<?php session_start(); ?>


<?php require 'functions/functions.php' ?>
<?php register(); ?>


<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="res/style.css">
</head>
<body id="signInPage">

<!--The form for the register -->

<?php
include('res/elements/header.php');
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="signInBox box"><br>
        <h1 class="bigsign" ><br>Register</h1>
        <br>
        <br>
        <input class="box" type="email" name="email" placeholder="    Enter Email Address"   required><br>
        <br>
        <input class="boxT" type="text" name="fname" placeholder="    Enter First Name"   required><br>
        <br>
        <input class="boxT" type="text" name="lname" placeholder="    Enter Last Name"   required><br>
        <br>
        <input class="box" type="password" name="password" placeholder="    Enter Password"  required><br>
        <br>
        <br><input  class="box" type="submit" name="submit" value="Register" ><br>
        <br>
        <p style="padding-top:60px;">Have an Account ?<br> Sign in  <a href="signin.php">Here</a>
    </div>
</form>

<!--The gif birds -->

<img src="res/images/bird-1mb.gif" class="birdLeft">
<img src="res/images/bird-1mb.gif" class="birdRight">

<?php
include('res/elements/footer.php');
?>

</body>
</html>
