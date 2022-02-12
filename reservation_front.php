<?php
    session_start();
    require 'functions/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="res/style.css">
        <title>Room Reservation</title>
    </head>
    <body>

    <!--reservation for rooms page-->

        <?php
            require('res/elements/header.php');
        ?>
        <div class="body1">
            <div class="container1">
                <div class="title1"><h1>Reservation</h1></div><br>
                    <form method="post">
                        <div class="form_details1">
                            <div class="input_box1">
                                <div class="details1"><h3>CheckIn</h3></div>
                                <input type="date" name="checkIn" placeholder="CheckIn" min="2021-12-31"  required>
                            </div>

                            <div class="input_box1">
                              <div class="details1"><h3>CheckOut</h3></div>
                              <input type="date" name="checkOut" placeholder="CheckOut" min="2021-12-31"  required>
                            </div>

                            <div class="input_box1">
                              <div class="details1"><h3>Room</h3></div>
                                <select name="roomsList" class="reservationfrontselecter">
                                    <?php
                                        dropDownRoom();
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="input_box1">
                              <div class="button1">
                                    <input type="submit" name="submit" value="Make a Reservation" >
                                    <?php
                                        roomReservation();
                                    ?>
                              </div>
                            </div>

                             <div class="input_box1">
                             </div>
                            <br>

                            <div class="input_box1">
                            </div>
                            <br>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            require('res/elements/footer.php')
        ?>
    </body>
</html>