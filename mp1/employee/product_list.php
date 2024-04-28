<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product List</title>
    </head>
    <body>
    <?php  
        include 'bar.php'; 
    ?>
        <link rel="stylesheet" href="../css/employee.css?3265894">
        <?php
            //include_once 'bar.php';
            include_once '../functions/employee.php';
            include_once '../functions/productsAndCategories.php';
            $sql='SELECT p.*, c.category_name 
            FROM products p 
            INNER JOIN categories c ON p.category_id = c.category_id ';
            $condition='';
            $name='';
            $order='';
            $category='';
            // Check if the form has been submitted
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                // Check if the 'query' parameter is set
                if (isset($_GET['name'])) {
                    // Retrieve and sanitize the value of the 'query' parameter
                    $search_query = trim(htmlspecialchars($_GET['name']));
                    // Use $search_query for further processing, such as querying a database or performing a search
                    if($search_query!=NULL){
                        $condition.="WHERE p.name LIKE '$search_query' ";
                        $name=$search_query;
                    }
                }
            
                // Check if the 'category_id' parameter is set
                if (isset($_GET['category_id'])) {
                    // Retrieve and sanitize the value of the 'category_id' parameter
                    $category_id = htmlspecialchars($_GET['category_id']);

                    // Use $category_id for further processing, such as querying a database based on category
                    if($category_id!=NULL){
                        $category=$category_id;
                        $x=implode(',', get_subcategory_list($category_id));
                        $category_list="p.category_id IN (".$x.')';
                        if($condition!=NULL){
                            $condition.='AND '.$category_list;
                        }
                        else{
                            $condition.='WHERE '.$category_list;
                        }
                    }
                }
            
                // Check if the 'sort' parameter is set
                if (isset($_GET['sort'])) {
                    // Retrieve and sanitize the value of the 'sort' parameter
                    $sort_option = htmlspecialchars($_GET['sort']);
                    $sort=' ORDER BY p.rate ';
                    // Use $sort_option for further processing, such as sorting query results
                    switch($sort_option){
                        case 'a':
                            $sort.='ASC';
                            break;
                        case 'd':
                            $sort.='DESC';
                            break;
                        
                    }
                    $order=$sort_option;
                    $condition.=$sort;
                }
            }

            //page no and item limit
            $page=isset($_GET['page'])?$_GET['page']:1;
            $itemsPerPage = 30;
            $offset = ($page - 1) * $itemsPerPage;
            $limitClause = "LIMIT $itemsPerPage";
            $offset = ($offset != 0) ? "OFFSET $offset" : '';
            
            //Final Condition
            $sql .= $condition." ORDER BY p.product_id DESC $limitClause $offset";
        ?>
        <!-- actual content -->
        <div class="addNew">

        </div>
        <form class="product_list" id='form' method='get'>
            <input type="text" name='name' maxlength="15" value="<?php echo $name?>">
            <select name="category_id">
                <option value="" selected disabled hidden>Category</option>
                <option value='0' >All</option>
                <?php
                    include_once '../functions/productsAndCategories.php';
                    echo display_category($conn,0,1,$category);
                ?>
            </select>
            <select name="Rate" id="">
                <option value="" selected disabled hidden>Rate</option>
                <!-- Option for sorting low to high -->
                <option value="a" <?php echo ($order == 'a') ? 'selected' : ''; ?>>Low to High</option>
                <!-- Option for sorting high to low -->
                <option value="d" <?php echo ($order == 'd') ? 'selected' : ''; ?>>High to Low</option>
            </select>

            <input type="submit" name="Search" class='sort'>
            <?php
                echo product_list($conn,$sql);
            ?>

        </form>
    </body>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="product.js?50"></script>
</html>