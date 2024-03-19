<?php 
    include '../db.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $message = array(); // Initialize message array

    if (!isset($user_id)){
        header('location:../login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:../home.php');
    }
    if (isset($_POST['submit-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message_text = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name='$name' AND email='$email' AND number='$number' AND message='$message_text'") or die ('query failed');
        if (mysqli_num_rows($select_message) > 0){
            $message[] = 'Message already sent';
        }else{
            mysqli_query($conn, "INSERT INTO `message` (`name`, `email`, `number`, `message`) VALUES('$name', '$email', '$number', '$message_text')") or die ('query failed');
            $message[] = 'Message sent successfully'; 
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

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    
    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

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

<!----========== SERVICES =============---->
<div class="services">
    <div class="row">

<!-- =============================================== SERVICES / FEATURES =================================================================
        <div class="box">
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

<?php  
    if (!empty($message)) {
        foreach($message as $msg) {
            echo '
                <div class="message">
                    <span>'.$msg.'</span>
                    <i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>';      
        }
    }
?>

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
            <button type="submit" name="submit-btn" class="message-btn">send message</button>
        </div>
    </form>
</div>

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
<script type="text/javascript" src="../js/script2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
