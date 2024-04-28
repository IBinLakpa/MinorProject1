<?php
include_once '../functions/productsAndCategories.php';

// Check if ID is provided via GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id != 'new') {
        // Fetch product details based on the provided ID
        $sql = "SELECT p.*, c.category_name 
        FROM products p 
        INNER JOIN categories c ON p.category_id = c.category_id
        WHERE p.product_id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $categoryName = $row['category_name'];
            $category=display_category($conn,0,1,$row['category_id']);
            $name = $row['name'];
            $rate = $row['rate'];
        } else {
        }
    }
    else{
        $categoryName='';
        $category = display_category($conn);
        $name = '';
        $rate = '';
    }
} else {
    header('Location: ../index.php');
}
if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
    $category = isset($_POST['category_id']) ? mysqli_real_escape_string($conn, $_POST['category_id']) : null;
    $price = isset($_POST['rate']) ? mysqli_real_escape_string($conn, $_POST['rate']) : null;

    // Check if the product with the given ID exists
    $checkProduct = "SELECT product_id FROM products WHERE product_id = $id";
    $result = mysqli_query($conn, $checkProduct);

    if (mysqli_num_rows($result) > 0) {
        // Build the update query dynamically based on the provided values
        $updateFields = array();
        if ($name !== null) {
            $updateFields[] = "name = '$name'";
        }
        if ($category !== null) {
            $updateFields[] = "category_id = '$category'";
        }
        if ($price !== null) {
            $updateFields[] = "rate = '$price'";
        }

        // Perform the update only if there are fields to update
        if (!empty($updateFields)) {
            $updateQuery = "UPDATE products SET " . implode(', ', $updateFields) . " WHERE product_id = $id";
            mysqli_query($conn, $updateQuery);
        }

        // Handle file upload only if a file is provided
        if (!empty($_FILES['image']['name'])) {
            $targetDirectory = "../images/products/";  // Set your target directory
            $info = pathinfo($_FILES['image']['name']);
            if (isset($info['extension'])) { // Check if 'extension' key exists
                $ext = $info['extension'];
                $targetFile = $targetDirectory . $id . '.' . $ext;
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            }
        }

        header('location: product_list.php');
        exit();
    } else {
        echo "Product with ID $id not found.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
<link rel="stylesheet" href="../css/bar.css?7455">
<link rel="stylesheet" href="../css/form.css?244">
<link rel="stylesheet" href="../css/employee.css?244">
    <?php include_once 'bar.php';?>

    <form action="" method="post" enctype="multipart/form-data">
    <h2>Edit Product</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="nameInput" name="name" oninput='updateName()' value="<?php echo $name; ?>"><br><br>
        
        <input type="file" id="image" name="image" accept="image/jpeg" onchange="updateImg()"><br><br>
        <select name="category_id" id='categorySelection' oninput="updateCategory()">
                <option value="" selected disabled hidden>Category</option>
                <option value='0' >All</option>
                <?php
                    
                    echo $category;
                ?>
            </select>
        <label for="rate">Rate:</label><br>
        <input type="number" id="rateInput" name="rate" value="<?php echo $rate; ?>" oninput='updateRate()'><br><br>
        <input type="submit" name="submit" value="Update">
    </form>
    
    <link rel="stylesheet" href="../css/product.css?435214">
    <div class='product'>
    <h2>Preview</h2>
        <?php echo "
            <div class='product_img' id='preview' style='background-image: url(../images/products/$id.jpg)'>
                <div class='qty'>
                    <span class='sub b'>-</span>
                    <span class='q'>0</span>
                    <span class='add b'>+</span>
                </div>
            </div>
            <article>
                <h1 id='name'>$name</h1>
                <h3 id='category'>$categoryName</h3>
                <h4>Rs <span id='rate'>$rate</span></h4>
            </article>
            "
        ?>
    </div>
    <script src="product.js?50"></script>

</body>

</html>
