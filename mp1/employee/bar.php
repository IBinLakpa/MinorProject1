
<link rel="stylesheet" href="../css/bar.css?784956">
<header>
    <img src="../images/icons/menu.svg" alt="menu" class="menu svg-image" onclick="togglemenu()">
    <div class="barcontent">
        
        
        <?php
                
                echo '
                    <div class="dropdown">
                        <div class="dropdown-content">
                            <a href="product_list.php" class="btn">Product List</a>
                            <a href="product_add.php" class="btn">Product Add</a>
                            <a href="category_add.php" class="btn">Category Add</a>
                            
                            <a href="category_edit.php" class="btn">Category Edit</a>
                            <a href="history.php" class="btn">Orders</a>
                        </div>
                    </div>
                ';
            
        ?>
    </div>
    
</header>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="../shop/script.js?50"></script>