<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>  

    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"><img src="../img/logo.png" width="80px" ></a>
            <nav class="navbar">
                <a href="admin_pannel.php">home</a>
                <a href="admin_sales.php">Sales</a>
                <a href="admin_product.php">products</a>
                <a href="admin_order.php">order</a>
                <a href="admin_user.php">user</a>
                <a href="admin_message.php">message</a>
            </nav>

            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <div class="user-box">
                <p>username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">logout</button>
                </form>
            </div>
        </div>
    </header>

        <div class="banner">
            <div class="detail">
                <h1>Admin dashboard</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
            </div>
        </div>

        <div class="line">

        
        </div>

</body>
</html>