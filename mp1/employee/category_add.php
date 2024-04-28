<?php
@include_once '../config.php';
include_once '../functions/productsAndCategories.php';
$category = display_category($conn);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category_id']);

    // Insert category into database
    $insert = "INSERT INTO categories (category_name, root_category) 
        VALUES ('$name', '$category')";
    mysqli_query($conn, $insert);

    header('location:category_add.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="../css/form.css">
    
</head>

<body>
    <?php  
        include 'bar.php';
    ?>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>add category</h3>
            <select required name="category_id" id='categorySelection' oninput="updateCategory()">
                <option value="" selected disabled hidden>Category</option>
                <option value='0' >All</option>
                <?php
                    echo $category;
                ?>
            </select>
            <input type="text" name="name" required placeholder="enter category name">
            <input type="submit" name="submit" value="Add Category" class="form-btn">
        </form>
    </div>
</body>

</html>
