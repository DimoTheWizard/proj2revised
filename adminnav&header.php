
    <div class="sidebar">
        <div class="sidebar-head">
            <h1><a href='indexAdmin.php'>Panel</h1>
        </div>
        <div>
            <ul class=sidebar-menu>
                <li><a href="addU.php">Add users</a></li>
                <li><a href="addR.php">Add reservations</a></li>
                <li><a href="addA.php">Add activities</a></li>
                <li><a href="readU.php">Edit / Delete users</a></li>
                <li><a href="readR.php">Edit / Delete reservations<a></li>
                <li><a href="readA.php">Edit / Delete activities</a></li>
            </ul>
        </div>
        <div class='logout'>
            <a href="?destroy">
                <input type="button" name="logout" value="Logout">
            </a>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="title">
                <h1>Dashboard</h1>
            </div>
            <div class='logo1'>
                <img src="../PROJECT2/res/images/logo.png" alt='logo'>
            </div>
            <div class="profile">
                <img src="me.png" alt="profile pic1">
                <div>
                    <!-- username can be automatically put here -->
                        <h4> John Doe <!--<?php echo $_SESSION['username']; ?>--> </h4>
                     <!-- uer level can be automatically put here -->
                        <small>Admin level <!-- <?php echo $_SESSION['usrLevel']; ?>--> </small>
                </div>
            </div>
        </header>