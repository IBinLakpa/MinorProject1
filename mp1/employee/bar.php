<link rel="stylesheet" href="../css/bar.css">
<header>
    
        <a href="index.php?page=1#" class="home-btn">Home</a>
        <a href="add_product.php" class="home-btn">Add Product</a>
                <a href="add_employee.php" class="home-btn">Add Employee</a>
        
    <?php
        if(isset($_SESSION['user_id'])){
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
        //else{
        //    if('login.php'!= basename($_SERVER['REQUEST_URI'])){
          //      header('location:../index.php');
            //}
        //}automatic exit commented out for ease of access
    ?>
</header>
