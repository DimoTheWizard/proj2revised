<?php
        session_start();
?>
<?php

// Initialize the session

    require_once "res/elements/session.php";

// Include config file

    require_once "res/elements/dbCon.php";

// Define variables and initialize with empty values

    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    // Processing form data when form is submitted

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if email is empty

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials

   if(empty($email_err) && empty($password_err)){

       // Prepare a select statement

       $sql = "SELECT * FROM login  WHERE email = ?";

       if($stmt = mysqli_prepare($conn, $sql)){

           // Bind variables to the prepared statement as parameters

           mysqli_stmt_bind_param($stmt, "s", $param_email);

           // Set parameters

           $param_email = $email;

           // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){
               // Store result
               
               mysqli_stmt_store_result($stmt);

               // Check if email exists, if yes then verify password
               if(mysqli_stmt_num_rows($stmt) == 1){
                // Bind result variables
                // mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                //  if(mysqli_stmt_fetch($stmt)){
                //      if(password_verify($password, $hashed_password)){
                        // Password is correct, so start a new session
                        // session_start();

                    header("Location: reservation.php");

                        // Store data in session variables

                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;

                } else{

                    //Password is not valid, display a generic error message

                    $login_err = "Invalid email or password.";
                }
            }
        }else{

            // email doesn't exist, display a generic error message

            $login_err = "Invalid email or password.";
        }
    }else{
    echo "Oops! Something went wrong. Please try again later.";
    }

    //Close statement
    
    mysqli_stmt_close($stmt);
    }
    //}
    //Close connection
    //mysqli_close($conn);
    //}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/style.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <?php
        require('res/elements/header.php');
    ?>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
        ?>

        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit"  name ="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>