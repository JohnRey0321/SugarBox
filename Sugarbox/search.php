<?php 

    include 'db.php';

        //ADDING PRODUCTS TO WISHLIST
        if (isset($_POST['add_to_wishlist'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
    
            $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die ('query failed');
            
            if (mysqli_num_rows($wishlist_number) > 0 ){
                $message[] = 'product already exist in wishlist';
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
                <h1>Our Shop</h1>
                <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
                <a href="index.php">HOME/</a><span> SEARCH RESULT</span>
            </div>
        </div>


        <!----========== SEARCH RESULT =============---->
        <div class="product-display">
      <h1 class="result">Search Result</h1>
      <table class="table table-hover">
<!--==================================================== TABLE HEADER ======================================================================
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>   
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
======================================================= END TABLE HEADER =============================================================== -->

        <?php
      
      if(isset($_GET['search'])){
        $filtervalues = $_GET['search'];
        echo "<p class='search-result'>You searched for: <b>$filtervalues</b></p>";
        $query = "SELECT * FROM products WHERE CONCAT(image,name,product_detail,price,category) LIKE '%$filtervalues%'";
        $query_run = mysqli_query($conn, $query);
        if(mysqli_num_rows($query_run) > 0){
          foreach($query_run as $items){

          ?>
          <tr>
            <td><img src="admin/image/<?php echo $items['image']; ?>" height="150" alt=""></td>
            <td><?=$items['name']; ?></td>
            <td>₱ <b><?=$items['price']; ?></b></td>
            <td>Category: <b><?=$items['category']; ?></b></td>
            <td>
            <div class="icon">
                    <a href="view_page.php?pid=<?php echo $items['id'];?>" class="bi bi-eye-fill"></a>
                </div>
        </td>
          </tr>
          
          <?php
        }
        }else{
          echo '<p class="empty">No products found! <i class="bi bi-emoji-frown"></i></p>';
          ?>
          <?php
        }
      }
      
      ?>
    </table>
        <!----========== ABOUT US END =============---->

<?php include 'footer.php'; ?>

        <!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="js/script.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>