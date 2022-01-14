<?php
        session_start();
?>
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
                <div class="title1"><h1>Reservation</h1></div><br>
                    <form action='reservation_back.php' method="post">
                        <div class="form_details1">
                            <div class="input_box1">
                                <div class="details1"><h3>First name</h3></div>
                                <input type="text" name="fname" placeholder="Enter your first name"  required>
                            </div>

                            <div class="input_box1">
                                <div class="details1"><h3>Last name</h3></div>
                                <input type="text" name="lname" placeholder="Enter your last name" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1"><h3>E-mail</h3></div>
                                <input type="email" name="email" placeholder="Enter your E-mail" required>
                            </div>
                            <br>
                            <div class="input_box1">
                                <div class="details1"><h3>CheckIn</h3></div>
                                <input type="date" name="checkIn" placeholder="CheckIn" min="2021-12-31"  required>
                             </div>

                             <div class="input_box1">
                                <div class="details1"><h3>CheckOut</h3></div>
                                <input type="date" name="checkOut" placeholder="CheckOut" min="2021-12-31"  required>
                            </div>
                            <br>

                            <div class="input_box1">
                                <div class="details1"><h3>Room class</h3></div>
                                <select class="reservationfrontselecter">
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
