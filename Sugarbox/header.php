<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="css/style2.css">
    <title>Document</title>
</head>
<body>  

    <header class="header">
        <div class="flex">
            <a href="home.php" class="logo"><img src="img/logo.png" width="80px" ></a>
            <nav class="navbar">    
                <a href="home.php">home</a>
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
                <a href="login.php"><i class="bi bi-envelope"></i></a>
                <a href="login.php"><i class="bi bi-heart"></i></a>
                <a href="login.php"><i class="bi bi-cart"></i></a>
                <a href="login.php"><i class="bi bi-bell"></i></a>
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <div class="user-box">
                <h3>Welcome!</h3>
                <form method="post">
                    <a href="login.php" class="login-btn">login</a>
                </form>
            </div>
        </div>
    </header>
</body>
</html>