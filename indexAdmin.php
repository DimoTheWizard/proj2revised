
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
        <main>
            <div class="cards">
                <div class="card-uno">
                    <!-- Number of rooms available -->
                    <span><h1 class='stats'> 25 </h1>
                    <div class='word'>Available Rooms </div></span>
                </div>

                <div class="card-uno">
                    <!-- Number of rooms booked -->
                    <span><h1 class='stats'> 25 </h1>
                    <div class='word'> Booked Rooms </div></span>
                </div>

                <div class="card-uno">
                    <!-- Number of tables available -->
                    <span><h1 class='stats'> 25 </h1>
                    <div class='word'> Available Tabels </div></span>
                </div>

                <div class="card-uno">
                    <!-- Number of tables booked -->
                    <span><h1 class='stats'> 25 </h1>
                    <div class='word'> Booked Tabels </div></span>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
