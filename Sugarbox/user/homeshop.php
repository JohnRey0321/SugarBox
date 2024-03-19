<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

    <!----========== SLICK CSS =============---->
    <link rel="stylesheet" href="../slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css">

    <title>Sugar Box - Home Page</title>
</head>
<body>


    <section class="popular-product">
        <h2>RECENTLY ADDED</h2>
        <div class="control">
            <i class="bi bi-chevron-left left"></i>
            <i class="bi bi-chevron-right right"></i>

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
        </div>

        <div class="popular-product-content">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if (mysqli_num_rows($select_products) > 0 ){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
       
            ?>

            <form method="post" class="card">
                <img src="../admin/image/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="price">₱ <?php echo $fetch_products['price']; ?>/-</div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>

                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
                <input type="hidden" name="product_quantity" value="1" min="1">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="bi bi-eye-fill"></a>
                    <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
            </form>

            <?php 
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
    </section>


    <!----========== SLICK SLIDER LINK JS =============---->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="../slick/slick.js"></script>
    
        <!----========== CUSTOM JS =============---->
        <script type="text/javascript" src="../js/script2.js"></script>

    <script type="text/javascript">
        $('.popular-product-content').slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: $('.right'),
            prevArrow: $('.left'),
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
            });
    </script>
</body>
</html>