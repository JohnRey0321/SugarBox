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
        }else if (mysqli_num_rows($wishlist_number) > 0 ) {
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

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <title>Home Page</title>
</head>
<body>
<?php include 'header.php'; ?>

<!----========== HOME SLIDER =============---->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../img/slider.jpg" class="d-block w-100" alt="...">
        <div class="slider-caption">
            <span>Test The Quality</span>
            <h1>Cupcake</h1>
            <p>A food product made from the fruit of a cacao tree (Theobroma cacao).</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="carousel-item">
      <img src="../img/slider3.png" class="d-block w-100" alt="...">
        <div class="slider-caption">
            <span>Test The Quality</span>
            <h1>Birthday Cake Special</h1>
            <p>A food product made from the fruit of a cacao tree (Theobroma cacao).</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="carousel-item">
      <img src="../img/slider2.jpg" class="d-block w-100" alt="...">
         <div class="slider-caption">
            <span>Test The Quality</span>
            <h1>Cake Customization</h1>
            <p>A food product made from the fruit of a cacao tree (Theobroma cacao).</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




<div class="services">
    <div class="row">       
        <div class="box">

<!-- =============================================== SERVICES / FEATURES =================================================================
            <img src="../img/shipping.png" alt="">
        <div>
            <h1>Free Shipping</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
        </div>
    </div>
    <div class="box">
            <img src="../img/cashback.png" alt="">
        <div>
            <h1>Money Back Guarantee</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
        </div>
    </div>
    <div class="box">
            <img src="../img/support.png" alt="">
        <div>
            <h1>Online Support 24/7</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
            </div>
=============================================== SERVICES / FEATURES ================================================================== -->
        </div>
    </div>
</div>

<div class="story">
     <div class="row">
        <div class="box">
            <span>Our Story</span>
            <h1>Maker of cakes in Manjuyod</h1>
            <p>Sugar box cakes and more in manjuyod</p>
            <a href="about.php" class="btn">Learn more</a>
        </div>
        <div class="box">
            <img src="../img/cakes/18.png" alt="">
        </div>
     </div>
</div>

<!--========= DISCOVER ==========-->
    <div class="discover">
        <div class="detail">
            <h1 class="title">Sugar Box Cakes and More</h1>
            <span>Buy Now!</span>
            <P>Cake is a flour confection made from flour, sugar, and other ingredients and is usually baked. In their oldest forms, cakes were modifications of bread, but cakes now cover a wide range of preparations that can be simple or elaborate and which share features with desserts such as pastries, meringues, custards, and pies.</P>
            <a href="shop.php" class="btn">Discover now</a>
        </div>
        <div class="img-box">
            <img src="../img/cakes/17.png" alt="">
        </div>
    </div>

    <?php include 'homeshop.php';?>


<?php include 'footer.php';?>

<!----========== SLICK SLIDER LINK JS =============---->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
 <script type="text/javascript" src="../js/script2.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>