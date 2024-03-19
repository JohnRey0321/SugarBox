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

    <title>Contact</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="banner">
            <div class="detail">
                <h1>contact us</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> CONTACT</span>
            </div>
        </div>


<!--======================================================= SERVICE ========================================================================
<div class="services">
    <div class="row">
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
    </div>
</div>
========================================================= END SERVICE ===================================================================-->



<!--==================================================== SEND A MESSAGE =================================================================-->
<div class="form-container">
    <h1 class="title">leave a message</h1>
    <form method="post">
        <div class="input-field">
            <label>your name</label><br>
            <input type="text" name="name" required>
        </div>
        <div class="input-field">
            <label>your email</label><br>
            <input type="text" name="email" required>
        </div>
        <div class="input-field">
            <label>Number</label><br>
            <input type="number" name="number" required>
        </div>
        <div class="input-field">
            <label>your message</label><br>
            <textarea name="message" required></textarea>
            <a href="login.php" class="send-message">SEND MESSAGE</a>
        </div>
    </form>
</div>
<!--================================================== END SEND A MESSAGE ===============================================================-->

    <div class="address">
        <h1 class="title">our contact</h1>
        <div class="row">
            <div class="box">
                <div>
                    <h4>Address</h4>
                    <i class="bi bi-map-fill"></i>
                    <p>6208, Negros Oriental, Manjuyod</p>
                </div>

                <div>
                    <h4>Mobile Number</h4>
                    <i class="bi bi-telephone-fill"></i>
                    <p>09123456789</p>
                </div>

                <div>
                    <h4>Email</h4>
                    <i class="bi bi-envelope-fill"></i>
                    <p>sugarbox@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

        <!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="js/script.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>