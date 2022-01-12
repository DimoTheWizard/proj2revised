<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
    <?php
        require("adminnav&header.php")
    ?>
    <div class="body1">
            <div class="container1">
            <div class="title1"><b>Activities</b></div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                    <div class="form_details1">
                            <div class="input_box1">
                                <div class="details1">Username</div>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">E-mail</div>
                                <input type="email" name="email" placeholder="E-mail" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">Event</div>
                                <input type="text" name="roomName" placeholder="Event Name" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">Set Date</div>
                                <input type="date" name="availabilty" placeholder="Set Date" min="2022-01-01" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1">Last Date</div>
                                <input type="date" name="availability" placeholder="Last Date" min="2022-01-01" required>
                            </div>

                            <div class="input_box1">
                                <div class="details1"> Quantity</div>
                                <input type='number' name='quantity' min='5' max='50'>
                            </div>

                            <div class="button1">
                                <input type="submit" name="submit" value=" Submit Event" >
                            </div>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>