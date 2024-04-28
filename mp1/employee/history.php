<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History</title>
        
      
    </head>
    <body>

        <?php
        include 'bar.php';
        include '../functions/history.php';
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                
            ?>
            <link rel="stylesheet" href="../css/order.css?84561">
            <link rel="stylesheet" href="../css/cart.css?84561">
            <div class="history">
                <b>Order Id</b>
                <b>Customer Id</b>
                <b>Shipping Address</b>
                <b>Delivery Charge</b>
                <b>Delivery Status</b>
                <b>Total Cost</b>
                <?php
                echo get_history();
                ?>
            </div>
    </body>
</html>