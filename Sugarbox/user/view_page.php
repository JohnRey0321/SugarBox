<?php 

    include '../db.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)){
        header('location:../login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
    }

        //ADDING PRODUCTS TO WISHLIST
        if (isset($_POST['add_to_wishlist'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];

            $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');
            $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');
            
            if (mysqli_num_rows($wishlist_number) > 0 ){
                $message[] = 'product already exist in wishlist';
            }else if (mysqli_num_rows($cart_num) > 0 ) {
                $message[] = 'product already exist in cart';
            }else{
                mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== BOOTSTRAP ICON LINK ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Home Page</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="banner">
            <div class="detail">
                <h1>Product Detail</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> SHOP</span>
            </div>
        </div>


        <!----========== ABOUT US =============---->
        <section class="view_page">
        <h1 class="title">Sop Best Seller</h1>
        
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


            <?php
                if (isset($_GET['pid'])){
                    $pid = $_GET['pid'];
                    $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die ('query failed');

                    if (mysqli_num_rows($select_products) > 0){
                        while($fetch_products = mysqli_fetch_assoc($select_products)){

            ?>
            <form method="post">
                <img src="../admin/image/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="detail">
                <div class="price">₱ <?php echo $fetch_products['price']; ?></div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail"><?php echo $fetch_products['product_detail'];?></div>
                    <div class="stock"><b>Stock left: </b><?php echo $fetch_products['stock']; ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">

                    <div class="icon">
                        <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                        <input type="number" name="product_quantity" value="1" min="0" class="quantity">
                        <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
                </div>
                   
            </form>

            <?php 
                       }
                    }
                }
            ?>
       
    </section>
        <!----========== ABOUT US END =============---->

<?php include 'footer.php'; ?>

        <!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="../js/script2.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>