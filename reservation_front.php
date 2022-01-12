<?php
            require 'functions/functions.php';

            reservePage();
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
        <?php
            require('res/elements/header.php');
        ?>
        <div class="body1">
            <div class="container1">
                <div class="title1">Reservation</div><br>
                    <form action='reservation_back.php' method="post">
                        <div class="form_details1">
                            <div class="input_box1">
                                <div class="details1">First name</div>
                                <input type="text" name="fname" placeholder="Enter your first name"  required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">Last name</div>
                                <input type="text" name="lname" placeholder="Enter your last name" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">E-mail</div>
                                <input type="email" name="email" placeholder="Enter your E-mail" required>
                            </div>
                            <br>
                            <div class="input_box1">
                                <div class="details1">CheckIn</div>
                                <input type="date" name="checkIn" placeholder="CheckIn" min="2021-12-31"  required>
                             </div>

                             <div class="input_box1">
                                <div class="details1">CheckOut</div>
                                <input type="date" name="checkOut" placeholder="CheckOut" min="2021-12-31"  required>
                            </div>
                            <br>

                            <div class="input_box1">
                                <div class="details1">Room class</div>
                                <select>
                                    <option value="firstClass">First Class</option>
                                    <option value="secondClass">Second Class</option>
                                </select>
                            </div>
                            <br>
                            <div class="button1">
                                  <input type="submit" name="submit" value=" Make a Reservation" >
                            </div>
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