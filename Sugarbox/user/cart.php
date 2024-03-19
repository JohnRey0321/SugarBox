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
    
        //UPDATING QUANTITY
        if (isset($_POST['update_qty_btn'])){
            $update_qty_id = $_POST['update_qty_id'];
            $update_value = $_POST['update_qty'];

            $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_qty_id'") or die ('query failed');
            if ($update_query){
                header('location:cart.php');
            }
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
                mysqli_query($conn, "DELETE FROM `cart` WHERE id = $delete_id") or die ('query failed');
                header('location:cart.php');
            }

           //DELETE ALL PRODUCTS FROM CART
           if (isset($_GET['delete_all'])){
        
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die ('query failed');
    
            header('location:cart.php');
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
                <h1>My Cart</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> CART</span>
            </div>
        </div>


        <!----========== ABOUT US =============---->
        <section class="shop">
        <h1 class="title">Product added in cart</h1>
        
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
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                if (mysqli_num_rows($select_cart) > 0 ){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
            <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_cart['pid'];?>" class="bi bi-eye-fill"></a>
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete this product from your cart?')"></a>
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
                <img src="../admin/image/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="price">₱ <?php echo $fetch_cart['price']; ?> /-</div>
                <div class="name"><?php echo $fetch_cart['name']; ?></div>

                <form method="post">
                    <input type="hidden"  name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>" >
                    <div class="qty">
                    <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>" >
                    <input type="submit" name="update_qty_btn" value="update">
                    </div>
                </form>

                <div class="total-amt"></div>
                        Total Amount: <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']) ?></span>
            </div>

            <?php 
                    $grand_total+=$total_amt;
                    }
                }else{
                    echo '<p class="empty">Your cart is empty!</p>';
                }
            ?>
        </div>

        <div class="dlt">
        <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your cart?')">delete all</a>
        </div>
                
        <div class="cart_total">
            <p>total amount payable:<b> ₱ <span><b><?php echo $grand_total;?> </b>/-</span></p>
            <a href="shop.php" class="btn">continue shoping</a>
            <a href="checkout.php?" class="btn <?php echo($grand_total>1)? '':'disabled' ?>">proceed to checkout</a>
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