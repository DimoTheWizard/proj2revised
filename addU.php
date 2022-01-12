
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
        <div class="title1"><b>New Users</b></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form_details1">
                    <div class="input_box1">
                        <div class="details1">Username</div>
                        <input type="text" name="Username" placeholder="Enter username" required>
                    </div>

                        <div class="input_box1">
                            <div class="details1">E-mail</div>
                            <input type="email" name="email" placeholder="Enter e-mail" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1">Password</div>
                            <input type="password" name="password" placeholder="Enter Password" required>
                        </div>

                        <div class="input_box1">
                            <div class="details1"> User Level</div>
                            <select class='addU' name='addU' id='addU'>
                                <option vlaue='guest'> Guest</option>
                                <option vlaue='vip'> VIP</option>
                                <option vlaue='guest'>Admin</option>
                            </select>
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