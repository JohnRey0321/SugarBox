<?php 
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="css/style2.css">

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
      <img src="img/slider.jpg" class="d-block w-100" alt="...">
        <div class="slider-caption">
            <span>Test The Quality</span>
            <h1>Cupcake</h1>
            <p>A food product made from the fruit of a cacao tree (Theobroma cacao).</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="carousel-item">
      <img src="img/slider3.png" class="d-block w-100" alt="...">
        <div class="slider-caption">
            <span>Test The Quality</span>
            <h1>Birthday Cake Special</h1>
            <p>A food product made from the fruit of a cacao tree (Theobroma cacao).</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="carousel-item">
      <img src="img/slider2.jpg" class="d-block w-100" alt="...">
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




>

<!--=================================================== FEATURES ===========================================================================
        <div class="box">
            <img src="img/shipping.png" alt="">
        <div>
            <h1>Free Shipping</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
        </div>
    </div>
    <div class="box">
            <img src="img/cashback.png" alt="">
        <div>
            <h1>Money Back Guarantee</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
        </div>
    </div>
    <div class="box">
            <img src="img/support.png" alt="">
        <div>
            <h1>Online Support 24/7</h1>
            <p>"Free Delivery," "Complimentary Shipping," "No Shipping Costs."</p>
            </div>
        </div>
=================================================== FEATURES ===========================================================================-->
   >


<div class="story">
     <div class="row">
        <div class="box">
            <span>Our Story</span>
            <h1>Maker of cakes in Manjuyod</h1>
            <p>Sugar box cakes and more in manjuyod</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <img src="img/cakes/18.png" alt="">
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
            <img src="img/cakes/17.png" alt="">
        </div>
    </div>

    <?php include 'homeshop.php';?>
    <?php include 'footer.php';?>


<!----==================================================== SLICK SLIDER LINK JS =======================================================---->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
        <script type="text/javascript" src="js/script2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>