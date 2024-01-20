<link rel="stylesheet" href="css/bar.css">
<header>
        <a href="index.php?page=1#" class="home-btn">Home</a>
        
    <?php
        session_start();
        if(isset($_SESSION['name'])){
            echo '
                <div class="dropdown">
                    <button class="dropbtn">Hi '.$_SESSION['name'].' ▼</button>
                    <div class="dropdown-content">
                        <a href="profile.php" class="btn">My Profile</a>
                        <a href="history.php" class="btn">History</a>
                        <a href="logout.php" class="btn">Logout</a>
                    </div>
                </div>
            ';
        }
        else{
            echo '
                
                    <span class= "home_btn"><a href="login_form.php">Log In</a> / <a href="register_form.php">Sign up</a></span>
            ';
        }
    ?>
</header>
<a href="cart.php" class="btn"><img class='cart'src='cart.jpg' alt="Cart"></a>
<link rel="stylesheet" href="css/style.css">
