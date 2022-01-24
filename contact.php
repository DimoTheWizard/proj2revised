<?php
        session_start();
?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {

        $fName = trim(htmlspecialchars($_POST['fName'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
        $lName = trim(htmlspecialchars($_POST['lName']));
        $email= trim(htmlspecialchars($_POST['email']));
        $desc = trim(htmlspecialchars($_POST['desc']));

        $finalName = $fName . ' ' . $lName;


/*Object Oriented style*/
        if (isset($_POST['submit'])) {
            $mail = new PHPMailer;
            $mail->isSMTP();      /*Port Definitition*/
            $mail->SMTPDebug = 0;
            $mail->Host = "smtp.gmail.com"; /*Host Port*/
            $mail->Port = "587"; // typically 587
            $mail->SMTPSecure = 'tls'; // ssl is depracated /*Security wise*/
            $mail->SMTPAuth = true;
            $mail->Username = "testinphp3@gmail.com";
            $mail->Password = "matthewariankrystianameli";
            $mail->setFrom("falconhotel@mail.com", "Falcon Hotel");
            $mail->addAddress($email, $finalName);
            $mail->Subject = 'Contact received';
            $mail->msgHTML($desc); // remove if you do not want to send HTML email
            $mail->AltBody = 'HTML not supported';

            $mail->send();

            if(!$mail->Send())
            {
                echo '<h2 style="color:red;">Couldnt send e-mail</h2>';
            }
            else
            {
                echo '<h2 style="color:green">E-mail sent</h2>';
            }
        }
    }
}

//require 'functions/functions.php';
//contact();

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Sign in Page</title>
        <link rel="stylesheet" href="res/style.css">
    </head>
    <body id = "contact">
    <?php
        include('res/elements/header.php');
    ?>
    <?php
        include('res/elements/footer.php');
    ?>

    <div class = "Contacttitle">
        <h1> Contact Our Customer Service </h1>
    </div>

    <form method="post">

      <div class = "contact">
        <h1> First Name </h1>
          <input type = "text" name = "fName" class = "customwidth" placeholder="First Name">
      </div>

      <div class = "contact">
        <h1> Last Name </h1>
          <input type = "text" name = "lName" class = "customwidth" placeholder="Last Name">
      </div>

      <div class = "contact">
        <h1> Email </h1>
          <input type = "text" name = "email"
          placeholder = "Enter your email" class = "customwidth">
      </div>

      <div class = "contact">
        <h1> Describe your problem </h1>
          <textarea name="desc" rows="5" cols="67"></textarea>
      </div>

        <div class = "contact">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>







    </form>
    </body>
</html>
