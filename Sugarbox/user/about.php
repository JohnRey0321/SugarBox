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
                <h1>About Us</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> ABOUT US</span>
            </div>
        </div>


        <!----========== ABOUT US =============---->
    <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>HELLO! With 25 experience</h1>
                </div>
                <p>For those of us who share an affinity for sweets, cake probably ‘takes the cake’ as our favorite dessert ever. It’s the one treat most commonly associated with momentous celebrations, and it can even manage to evoke nostalgia. Not to mention, a flavor profile exists for practically every taste, even those who don’t like chocolate (although we have to respectfully agree to disagree here). </p>
            </div>
            <div class="img-box">
                <img src="../img/logo.png" alt="">
            </div>
        </div>
    </div>
        <!----========== ABOUT US END =============---->


  
         <!----========== FEATURES =============-
         <div class="features">
            <div class="title">
                <h1>Complete Customer Idea</h1>
                <span>BEST FEATURES</span>
            </div>
            <div class="row">
                <div class="box">
                    <img src="../img/support.png" alt="">
                    <h4>24 x 7</h4>
                    <p>Online Support 24 / 7</p>
                </div>
                <div class="box">
                    <img src="../img/cashback.png" alt="">
                    <h4>Money Back Guarantee</h4>
                    <p>100% Secure Payment</p>
                </div>
                <div class="box">
                    <img src="../img/giftcard.png" alt="">
                    <h4>Special Gift Card</h4>
                    <p>Give The Perfect Gift</p>
                </div>
                <div class="box">
                    <img src="../img/shipping.png" alt="">
                    <h4>Local Delivery</h4>
                    <p>On Order Via Official Sugar Box Website</p>
                </div> 
            </div>
         </div> -->


<?php include 'footer.php'; ?>  

        <!--=============== SCRIPT JS ===================-->
    <script type="text/javascript" src="../js/script2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 