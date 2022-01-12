<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['submit'])) {

        $con = mysqli_connect('localhost', 'root', '','testdb')
        or die("Connection to the db failed" . mysqli_error($con));

        $email = trim(htmlspecialchars($_POST['email'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));

        $email = trim(mysqli_real_escape_string($con, $_POST['email']));
        $username = trim(mysqli_real_escape_string($con,$_POST['username']));
        $password = trim(mysqli_real_escape_string($con, $_POST['password']));

        $usrLevel = trim(mysqli_real_escape_string($con, 'guest'));
        $usrLevel = trim(htmlspecialchars('guest'));


        if(!empty($email) && !empty($username) && !empty($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){

                $hashPass = password_hash($password,
                    PASSWORD_ARGON2ID,
                    ['memory_cost' => 2048,
                        'time_cost' => 4,
                        'threads' => 3]);

            //$salt = 'somereallycoolsalttonotbrakpassw';

            //$hashSalt = $hashPass . $salt;

            $query = $con->prepare("INSERT INTO users (email,username,password, usrLevel) VALUES (?,?,?,?)");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("ssss", $email,$username ,$hashPass, $usrLevel);

            if (false === $query) {
                die('Bind param failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Execute failed' . htmlspecialchars($query->error));
            }

            echo 'Registration made';

            $con->close();


        }else {
            echo 'Email not valid';
        }



        } else {
            echo 'Make sure you have completed both fields !';
        }


    } else {
        die("Form couldn't be sent");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Live</title>
    <meta charset="UTF-8">
</head>
<body>
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="email">Email :</label>
    <input type="text" id="email" name="email" placeholder="Email"><br><br>
    <label for="email">Username :</label>
    <input type="text" id="username" name="username" placeholder="Username"><br><br>
    <label for="password">Password :</label>
    <input type="password" id="password" name="password" placeholder="Password"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
