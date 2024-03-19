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
    
        //ADDING PRODUCTS TO CART
        if (isset($_POST['add_to_cart'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = 1;
    
            
            $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');
            if (mysqli_num_rows($cart_num) > 0 ) {
                $message[] = 'product already exist in cart';
            }else{
                mysqli_query($conn, "INSERT INTO `cart`(`user_id`, `pid`, `name`, `price`, `quantity` ,`image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
                $message[] = 'product succesfully added in your cart';
            }
        }

        //DELETE PRODUCTS FROM WISHLIST
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = $delete_id") or die ('query failed');
        header('location:wishlist.php');
    }

           //DELETE PRODUCTS FROM WISHLIST
           if (isset($_GET['delete_all'])){
        
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die ('query failed');
    
            header('location:wishlist.php');
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

    <title>Home Page</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="banner">
            <div class="detail">
                <h1>My Wishlist</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> WISHLIST</span>
            </div>
        </div>


        <!----========== ABOUT US =============---->
        <section class="shop">
        <h1 class="title">Product added in wishlist</h1>
        
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
            $grand_total=0;
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
                if (mysqli_num_rows($select_wishlist) > 0 ){
                    while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
       
            ?>
            <form method="post" class="box">
                <img src="../admin/image/<?php echo $fetch_wishlist['image']; ?>" alt="">
                <div class="price">₱ <?php echo $fetch_wishlist['price']; ?> /-</div>
                <div class="name"><?php echo $fetch_wishlist['name']; ?></div>

                <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id'];?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name'];?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price'];?>">
                <input type="hidden" name="product_quantity" value="1" min="1">
                <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image'];?>">
                <div class="icon">
                <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid'];?>" class="bi bi-eye-fill"></a>
                <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete this product from your wishlist?')"></a>
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
            </form>

            <?php 
                    $grand_total+=$fetch_wishlist['price'];
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>

        <div class="dlt">
        <a href="wishlist.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your wishlist?')">delete all</a>
        </div>

        <div class="wishlist_total">
            <p>total amount payable:<b> ₱ <span><b><?php echo $grand_total;?> </b>/-</span></p>
            <a href="shop.php" class="btn">continue shoping</a>
            <a href="wishlist.php?delete_all" class="btn <?php echo($grand_total)? '':'disabled' ?>" onclick="return confirm('do you want to delete all items in your wishlist?')">delete all</a>
        </div>
    </section>
        <!----========== ABOUT US END =============---->

<?php include 'footer.php'; ?>

        <!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="../js/script2.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>