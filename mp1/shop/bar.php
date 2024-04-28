
<link rel="stylesheet" href="../css/bar.css?784956">
<header>
    <img src="../images/icons/menu.svg" alt="menu" class="menu svg-image" onclick="togglemenu()">
    <div class="barcontent">
        <a href="index.php" class="logo"><img src="../images/icons/logo.svg"></a>
        
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_SESSION['name'])){
                echo '
                    <div class="dropdown">
                        <div class="dropbtn">Hi '.$_SESSION['name'].' ▼</div>
                        <div class="dropdown-content">
                            
                            <a href="history.php" class="btn">History</a>
                            <a href="signout.php" class="btn" onclick="confirmSignOut()">Signout</a>
                        </div>
                    </div>
                ';
            }
            else{
                echo '
                    <div><a href="signin.php">Sign In</a> / <a href="signup.php">Sign up</a></div>
                ';
            }
        ?>
    </div>
    
</header>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="script.js?50"></script>