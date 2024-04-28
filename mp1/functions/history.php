<?php
function get_history($condition='', $page = 1) {
    $itemsPerPage = 30;
    $offset = ($page - 1) * $itemsPerPage;
    $condition .= ' LIMIT ' . $itemsPerPage;
    $condition .= ($offset != 0) ? ' OFFSET ' . $offset : '';

    include '../config.php';
    $details = '';

    $sql = "SELECT order_id, shipping_address, delivery_charge, customer_id, delivered FROM orders ".$condition;
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
            $shipping_address = $row['shipping_address'];
            $delivery_charge = $row['delivery_charge'];
            $delivered = $row['delivered'];
            $customer_id=$row['customer_id'];
            $total_cost = get_total_cost($order_id, $conn);

            $details .= "<a class='id' href='order.php?id=$order_id'>$order_id</a>";
            $details .= "<span class='customer'>$customer_id</span>";
            $details .= "<span class='shipping-address'>$shipping_address</span>";
            $details .= "<span class='delivery-charge'>$delivery_charge</span>";
            $details .= "<span class='delivered'>$delivered</span>";
            $details .= "<span class='total-cost'>$total_cost</span>";
        }
    }

    return $details;
}
function get_total_cost($order_id, $conn) {
    $sum = 0;
    $sql = "SELECT rate, quantity FROM orderproducts WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sum += ($row['rate'] * $row['quantity']);
        }
    }
    return $sum;
}
function get_productname($id, $conn) {
    $select = "SELECT name FROM products WHERE product_id = $id";
    $result = mysqli_query($conn, $select);    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    }
    return 0;
}