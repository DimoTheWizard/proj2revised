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

    <form>

      <div class = "contact">
        <h1> First Name </h1>
          <input type = "text" name = "fname" class = "customwidth">
      </div>

      <div class = "contact">
        <h1> Last Name </h1>
          <input type = "text" name = "fname" class = "customwidth">
      </div>

      <div class = "contact">
        <h1> Email </h1>
          <input type = "text" name = "fname"
          placeholder = "Enter your email" class = "customwidth">
      </div>

      <div class = "contact">
        <h1> Describe yout problem </h1>
          <textarea rows="5" cols="67">   </textarea>
    </form>







    </form>
    </body>
</html>
