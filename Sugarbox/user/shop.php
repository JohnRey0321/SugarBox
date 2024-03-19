<?php 

include '../db.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)){
    header('location:../login.php');
}
if (isset($_POST['logout'])){
    session_destroy();
    header('location:../home.php');
}

//ADDING PRODUCTS TO WISHLIST
if (isset($_POST['add_to_wishlist'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');

    if (mysqli_num_rows($wishlist_number) > 0 ){
        $message[] = 'product already exist in wishlist';
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
        $message[] = 'product succesfully added in your wishlist';
    }
}

//ADDING PRODUCTS TO CART
if (isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    
    $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');
    if (mysqli_num_rows($cart_num) > 0 ) {
        $message[] = 'product already exist in cart';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(`user_id`, `pid`, `name`, `price`, `quantity` ,`image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
        $message[] = 'product succesfully added in your cart';
    }
}

    // SELECTING CATEGORY
$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($category_filter == 'all') {
    $select_products = mysqli_query($conn, "SELECT * FROM products") or die('Query failed');
} else {
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE category = ?");
    mysqli_stmt_bind_param($stmt, "s", $category_filter);
    mysqli_stmt_execute($stmt);
    $select_products = mysqli_stmt_get_result($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== BOOTSTRAP ICON LINK ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

    <title>Sugarbox - Shop</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Our Shop</h1>
        <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
        <a href="index.php">HOME/</a><span> SHOP</span>
    </div>
</div>

<!----========== ABOUT US =============---->
<section class="shop">
    <h1 class="title-shop">Shop Best Seller</h1>

    <!-- Example single danger button -->
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="shop.php?category=all">All</a></li>
            <?php  
            // Fetch distinct categories from the products table
            $categories_query = mysqli_query($conn, "SELECT DISTINCT category FROM products") or die('Query failed');
            while($category = mysqli_fetch_assoc($categories_query)) {
                echo '<li><a class="dropdown-item" href="shop.php?category=' . urlencode($category['category']) . '">' . $category['category'] . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <?php  
    if (isset($message)) {
        foreach($message as $message) {
            echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>      
            ';
        }
    }

    ?>


    <div class="box-container">
        <?php
        if (mysqli_num_rows($select_products) > 0 ){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
       
        ?>
        <form method="post" class="box">
            <img src="../admin/image/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="price">₱ <?php echo $fetch_products['price']; ?> /-</div>
            <div class="name"><b><?php echo $fetch_products['name']; ?></b></div>
            <div class="stock">Stocks left: <b><?php echo $fetch_products['stock']; ?></b></div>

            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
            <input type="hidden" name="product_quantity" value="1" min="1">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
            <div class="icon">
                <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="bi bi-eye-fill"></a>
                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
        </form>

        <?php 
            }
        }else{
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</section>
<!----========== ABOUT US END =============---->

<?php include 'footer.php'; ?>

<!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
