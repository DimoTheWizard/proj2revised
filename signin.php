<?php
    session_start();
    require 'functions/functions.php';
    signIn();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign in Page</title>
        <link rel="stylesheet" href="res/style.css">
    </head>
    <body id="signInPage">

        <!--The form for the sign in -->

        <?php
            include('res/elements/header.php');
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="signInBox box"><br>
                <h1 class="bigsign" ><br>Sign in</h1>
                <br>
                <br>
                <input class="box" type="email" name="email" value="" placeholder="    Enter Email Address"   required><br>
                <br>
                <input class="box" type="password"name="password" value="" placeholder="    Enter Password"  required><br>
                <br>
                <br>
                <input  class="box" type="submit" name="submit" value="Sign in" ><br>
                <br>
                <p>Don't have an Account ?<br> Create one  <a href="register.php">Here</a>
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