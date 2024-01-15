<link rel="stylesheet" href="css/bar.css">
<header>
    <div>
        <a href="index.php?page=1#" class="home-btn">Home</a>
    </div>
        
    <?php
        if(isset($_SESSION['name'])){
            echo '
                <div class="dropdown">
                    <button class="dropbtn">Hi '.$_SESSION["name"].' ▼</button>
                    <div class="dropdown-content">
                        <a href="history.php" class="btn">History</a>
                        <a href="logout.php" class="btn">Logout</a>
                    </div>
                </div>
            ';
        }
        else{
            echo '
                <div>
                    <span class= "home_btn"><a href="login_form.php">Log In</a> / <a href="register_form.php">Sign up</a></span>
                </div>
            ';
        }
    ?>
</header>
