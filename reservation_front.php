<?php
            require('res/elements/session.php');
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
                                <input type="text" name="fname" placeholder="Enter your first name" value="<?php echo($_SESSION['fname'])?>" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">Last name</div>
                                <input type="text" name="lname" placeholder="Enter your last name" value="<?php echo($_SESSION['lname'])?>" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">E-mail</div>
                                <input type="email" name="email" placeholder="Enter your E-mail" value="<?php echo($_SESSION['email'])?>" required>
                            </div>
                            <br>
                            <div class="input_box1">
                                <div class="details1">CheckIn</div>
                                <input type="date" name="checkIn" placeholder="CheckIn" min="2021-12-31" value="<?php echo($_SESSION['checkIn'])?>" required>
                             </div>

                             <div class="input_box1">
                                <div class="details1">CheckOut</div>
                                <input type="date" name="checkOut" placeholder="CheckOut" min="2021-12-31" value="<?php echo($_SESSION['checkOut'])?>" required>
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