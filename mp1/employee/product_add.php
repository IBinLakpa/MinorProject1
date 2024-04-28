<?php
include_once '../functions/productsAndCategories.php';


        $categoryName='';
        $category = display_category($conn);
        $name = '';
        $rate = '';
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $category = mysqli_real_escape_string($conn, $_POST['category_id']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
        
            // Handle file upload
            $targetDirectory = "../images/products/";  // Set your target directory
        
            // Insert product into database
            $insert = "INSERT INTO products (name, category_id, rate) 
                VALUES ('$name', '$category', '$price')";
            mysqli_query($conn, $insert);
        
            // Get the last inserted product ID
            $productId = mysqli_insert_id($conn);
        
            // Generate a unique filename using the product_id
            $info = pathinfo($_FILES['image']['name']);
            $ext = $info['extension'];
            $targetFile = $targetDirectory . $productId.'.'.$ext;
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        
            header('location:product_list.php');
            exit();
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
<link rel="stylesheet" href="../css/bar.css?7455">
<link rel="stylesheet" href="../css/form.css?244">
<link rel="stylesheet" href="../css/employee.css?87456">
<?php  
        include 'bar.php'; 
    ?>
    

    <form action="" method="post" enctype="multipart/form-data">
    <h2>Add Product</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label><br>
        <input required type="text" id="nameInput" name="name" oninput='updateName()' value="<?php echo $name; ?>"><br><br>
        
        <input required type="file" id="image" name="image" accept="image/jpeg" onchange="updateImg()"><br><br>
        <select required name="category_id" id='categorySelection' oninput="updateCategory()">
                <option value="" selected disabled hidden>Category</option>
                <option value='0' >All</option>
                <?php
                    echo $category;
                ?>
            </select>
        <label for="rate">Rate:</label><br>
        <input type="number" id="rateInput" name="rate" required oninput='updateRate()'><br><br>
        <input type="submit" name="submit" value="Add">
    </form>
    
    <link rel="stylesheet" href="../css/product.css?435214">
    <div class='product'>
    <h2>Preview</h2>
        <?php echo "
            <div class='product_img' id='preview' '>
                <div class='qty'>
                    <span class='sub b'>-</span>
                    <span class='q'>0</span>
                    <span class='add b'>+</span>
                </div>
            </div>
            <article>
                <h1 id='name'></h1>
                <h3 id='category'></h3>
                <h4>Rs <span id='rate'></span></h4>
            </article>
            "
        ?>
    </div>
    <script src="product.js?50"></script>

</body>

</html>
