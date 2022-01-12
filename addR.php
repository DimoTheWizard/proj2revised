
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
   <?php
    require('adminnav&header.php')
   ?>
    <div class="body1">
        <div class="container1">
        <div class="title1"><b>Reservation</b></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form_details1">
                    <div class="input_box1">
                        <div class="details1">First name</div>
                        <input type="text" name="fname" placeholder="Enter your first name" required>
                    </div>

                        <div class="input_box1">
                            <div class="details1">Last name</div>
                            <input type="text" name="lname" placeholder="Enter your last name" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1">E-mail</div>
                            <input type="email" name="email" placeholder="Enter your E-mail" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1">CheckIn</div>
                            <input type="date" name="checkIn" placeholder="CheckIn" min="2021-12-31" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1">CheckOut</div>
                            <input type="date" name="checkOut" placeholder="CheckOut" min="2021-12-31" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1"> Quantity</div>
                            <input type='number' name='quantity' min='1' max='50'>
                        </div>

                        <div class="button1">
                            <input type="submit" name="submit" value=" Make a Reservation" >
                        </div>

                </div>
            </form>
        </div>
    </div>
</body>
</html>