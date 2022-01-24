<header>
    <div class="logo">
        <a href="index.php"><img src="res/images/logo.png" alt="logo"></a>
    </div>
    <nav>
        <!--Dont Put the elements in a list please it breaks the code
            also do not get rid of the classes because it broke the styling
            if you edit a important chunk of code that everyone
            uses dont forget to tell us!!!-->
            <div class="headerText"><a href="preview_activities.php" style="text-decoration:none; color:black;">Activities</a></div>
        <div class="headerText"><a href="reservation_front.php" style="text-decoration:none; color:black;">Reservations</a></div>

        <?php
            if(isset($_SESSION["isLogged"])){ /*checking from the header if it is logged */
                if($_SESSION["isLogged"] === "logged"){
                    echo "<div class=\"headerText\"><a href=\"functions/sessionDestroy.php\" style=\"text-decoration:none; color:black;\">Sign out</a></div>";
                    /*function that clears everthing from the session*/
                } else {
                    echo "<div class=\"headerText\"><a href=\"signin.php\" style=\"text-decoration:none; color:black;\">Sign in</a></div>";
                }
            } else {
                echo "<div class=\"headerText\"><a href=\"signin.php\" style=\"text-decoration:none; color:black;\">Sign in</a></div>";
            }
        ?>
    </nav>
</header>
