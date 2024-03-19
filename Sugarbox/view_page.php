<?php 

    include 'db.php';

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
    <link rel="stylesheet" href="css/style2.css">

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
                <img src="admin/image/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="detail">
                <div class="price">₱ <?php echo $fetch_products['price']; ?> /-</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail"><?php echo $fetch_products['product_detail'];?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">

                    <div class="icon">
                        <a href="login.php" class="bi bi-heart"></a>
                        <input type="number" name="product_quantity" value="1" min="0" class="quantity">
                        <a href="login.php" class="bi bi-cart"></a>
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
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>