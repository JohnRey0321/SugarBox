<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">
    <title>Document</title>
</head>
<body>  

    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo"><img src="../img/logo.png" width="80px" ></a>
            <nav class="navbar">    
                <a href="index.php">home</a>
                <a href="about.php">about us</a>
                <a href="shop.php">shop</a>
                <a href="contact.php">contact</a>
            </nav>

             <!--Search Box-->
            <form action="search.php" method="GET" id="searchForm">
                <input type="text" id="searchInput" name="search" value="<?php if(isset($GET['search'])){echo $_GET['search']; }?>" placeholder="Search here..." >
                <button class="search-btn bi bi-search" type="submit"></button>
            </form>
            
            <div class="icons">
            <?php 
                    $select_message = mysqli_query($conn, "SELECT * FROM `user_message` WHERE user_id='$user_id'") or die ('query failed');
                    $message_num_rows = mysqli_num_rows($select_message);
                ?>
                <a href="message.php"><i class="bi bi-envelope"></i><sup><?php echo $message_num_rows; ?></sup></a>
                <?php 
                    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die ('query failed');
                    $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows; ?></sup></a>
                <?php 
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die ('query failed');
                    $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows; ?></sup></a>
                
                <?php 
                    $select_notif = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id='$user_id'") or die ('query failed');
                    $notif_num_rows = mysqli_num_rows($select_notif);
                ?>
                <a href="notification.php?view="><i class="bi bi-bell"></i><sup><?php echo $notif_num_rows; ?></sup></a>
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <div class="user-box">
                <p>username: <span><b><?php echo $_SESSION['user_name']; ?></b></span></p>
                <p>email: <span><b><?php echo $_SESSION['user_email']; ?></b></span></p>
                <a class="btn" href="account.php">MY ACCOUNT</a>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">logout</button>
                </form>
            </div>
        </div>
    </header>
</body>
</html>