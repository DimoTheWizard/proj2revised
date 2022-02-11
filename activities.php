<?php
        session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id = "activities">
        <?php
            include('res/elements/header.php');
        ?>
        <?php
            include('res/elements/footer.php');
        ?>
        <?php
            include('functions/functions.php');
        ?>
        <div class = "Activitiestitle">
            <h1> Reserve a spot in an event </h1>
        </div>

        <!--Reserve event-->

        <div class = "activityImage"> </div>
        <form action = "activities.php" method = "post">
            <div class = "formbox">
                <div class = "formlabel">
                    <h1> Book An Event </h1>
                    <select name ="eventList" id ="eventlist">
                    <?php
                        dropDownEvent();
                    ?>
                    </select>
                </div>
                <div> </div>
                <input type ="submit" name="submit" value="Book Now" class="submitlabel">
            </div>
        </form>
          <?php
              activityReservation();
          ?>
          <div class = "activitytext">
          </div>
    </body>
</html>
