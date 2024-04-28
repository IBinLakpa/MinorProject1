<?php
    function product_list($conn,$sql) {
        $details='';
    
        // Execute the query
        $result = mysqli_query($conn, $sql);
    
        // Process the query result
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $name = $row['name'];
                $category_name = $row['category_name']; // Use category name instead of category ID
                $rate = $row['rate'];
    
                // Append product details to $details
                $details .= "<h5 class='name'>$name</h5>";
                $details .= "<h5 class='category'>$category_name</h5>"; // Use category name instead of category ID
                $details .= "<h5 class='rate'>$rate</h5>";
                $details .= "<a href='product.php?id=$product_id' class='edit'></a>";
            }
        }
    
        // Close database connection
        mysqli_close($conn);
    
        return $details;
    }
    
    
    function get_category_list($conn, $id) {
        $categoryList = [$id]; // Start with the current category ID
        $sql = "SELECT category_id FROM categories WHERE root_category = $id";
        $result = mysqli_query($conn, $sql);
        
        while ($row = $result->fetch_assoc()) {
            // Recursively call the function to get subcategories
            $subCategoryList = get_category_list($conn, $row['category_id']);
            // Merge the subcategory list with the current category list
            $categoryList = array_merge($categoryList, $subCategoryList);
        }
        
        return $categoryList;
    }
    function get_customername($conn, $id){
        $select = "SELECT * FROM customers WHERE customer_id = '$id'";
        $result = mysqli_query($conn, $select);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            return isset($row['m_name'])?$row['f_name'].' '.$row['m_name'].' '.$row['l_name']:$row['f_name'].' '.$row['l_name'];
        }
    }
?>