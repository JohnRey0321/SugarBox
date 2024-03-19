<?php 

    include '../db.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if (!isset($admin_id)){
        header('location:../login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style.css">

    <title>admin pannel</title>
</head>
<body>
    
<?php include 'admin_header.php'; ?>


        <!--============ DATA INVENTORY SECTION ==============-->
    <section class="product-display">
        <h1 class="result">RECENT PURCHASE</h1>
            <div class="scroll-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_orders = mysqli_query($conn, "SELECT * FROM `order` ORDER BY `order`.`id` DESC") or die ('query failed');
                            if (mysqli_num_rows($select_orders)>0){
                                while($fetch_orders = mysqli_fetch_assoc($select_orders)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_orders['user_id'];?></td>
                        <td><?php echo $fetch_orders['total_products'];?></td>
                        <td><?php echo $fetch_orders['method'];?></td>
                        <td><b><?php echo $fetch_orders['total_price'];?></b></td>
                        <td><?php echo $fetch_orders['placed_on'];?></td>
                        <td><span style="color: <?php if($fetch_orders['payment_status']=='Pending'){echo 'red';}; ?>" ><?php echo $fetch_orders['payment_status'];?></span></td>
        
                    </tr>
                </tbody>
                        <?php 
                                                
                                }
                                    }else{
                                echo '
                                    <div class="empty">
                                        <p>no order placed yet!</p>
                                    </div>';
                                }
                            ?>
                </table>
            </section>
        </div>
    </div>
        <!--========= STOCK INVENTORY ===========-->
        <section class="product-display">
            <h1 class="result">PRODUCTS</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die ('query failed');
                            if (mysqli_num_rows($select_products)>0){
                                while($fetch_products = mysqli_fetch_assoc($select_products)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_products['id'];?></td>
                        <td><?php echo $fetch_products['name'];?></td>
                        <td><?php echo $fetch_products['category'];?></td>
                        <td><?php echo $fetch_products['price'];?></td>
                        <td><?php echo $fetch_products['stock'];?></td>
                        <td><a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">UPDATE</a></td>
                                    
                    </tr>
                </tbody>
                        <?php 
                                                
                                }
                                    }else{
                                echo '
                                    <div class="empty">
                                        <p>no order placed yet!</p>
                                    </div>';
                                }
                            ?>
                </table>
            </section>

        </div>
    </div>

        
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>