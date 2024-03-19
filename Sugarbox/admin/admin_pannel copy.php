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
    <link rel="stylesheet" href="../css/stylecopy.css">

    <title>admin pannel</title>
</head>
<body>
    
<?php include 'admin_header copy.php'; ?>
        <section class="dashboard">
            <div class="box-container">
                <div class="box">
                    <?php

                    $total_pendings = 0;
                    $select_pendings = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status ='Pending'")
                        or die('query failed');
                    while ($fetch_pending = mysqli_fetch_assoc($select_pendings)){
                        $total_pendings += $fetch_pending['total_price'];
                        }
                    ?>
                    <h3>₱ <?php echo $total_pendings; ?>/-</h3>
                    <p>pending orders</p>
                </div>

                <div class="box">
                    <?php

                    $total_completes = 0;
                    $select_completes = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status ='Completed'")
                        or die('query failed');
                    while ($fetch_completes = mysqli_fetch_assoc($select_completes)){
                        $total_completes += $fetch_completes['total_price'];
                        }
                    ?>
                    <h3>₱ <?php echo $total_completes; ?>/-</h3>
                    <p>paid orders</p>
                </div>

                <div class="box">
                    
                    <?php
                        $select_orders = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
                        $num_of_orders = mysqli_num_rows($select_orders);
                    ?>
                    <h3><?php echo $num_of_orders; ?></h3>
                    <p>total placed order</p>
                    <a href="admin_order.php">More</a>
                </div>

                <div class="box">
                    <?php
                        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                        $num_of_products = mysqli_num_rows($select_products);
                    ?>
                    <h3><?php echo $num_of_products; ?></h3>
                    <p>total product added</p>
                    <a href="admin_product.php">More</a>
                </div>

                <div class="box">
                    <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                        $num_of_users = mysqli_num_rows($select_users);
                    ?>
                    <h3><?php echo $num_of_users; ?></h3>
                    <p>total normal users</p>
                </div>

                <div class="box">
                    <?php
                        $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                        $num_of_admin = mysqli_num_rows($select_admin);
                    ?>
                    <h3><?php echo $num_of_admin; ?></h3>
                    <p>total admin</p>
                </div>

                <div class="box">
                    <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                        $num_of_users = mysqli_num_rows($select_users);
                    ?>
                    <h3><?php echo $num_of_users; ?></h3>
                    <p>total registered users</p>
                    <a href="admin_user.php">More</a>
                </div>

                <div class="box">
                    <?php
                        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                        $num_of_message = mysqli_num_rows($select_message);
                    ?>
                    <h3><?php echo $num_of_message; ?></h3>
                    <p>new messages</p>
                    <a href="admin_message.php">More</a>
                </div>
            </div>
        </section>
    </div>


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

            <!--=============== REGISTERED USER ================-->
            <section class="product-display">
            <h1 class="result">REGISTERED USER</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die ('query failed');
                            if (mysqli_num_rows($select_users)>0){
                                while($fetch_users = mysqli_fetch_assoc($select_users)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_users['id'];?></td>
                        <td><?php echo $fetch_users['name'];?></td>
                        <td><?php echo $fetch_users['email'];?></td>
                        <td><span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'orange';}; ?>" ><?php echo $fetch_users['user_type'];?></span></td>
                                    
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


                        <!--=============== MESSAGES ================-->
            <section class="product-display">
            <h1 class="result">MESSAGE</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>

                        <?php 
                            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die ('query failed');
                            if (mysqli_num_rows($select_message)>0){
                                while($fetch_message = mysqli_fetch_assoc($select_message)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_message['id'];?></td>
                        <td><?php echo $fetch_message['name'];?></td>
                        <td><?php echo $fetch_message['email'];?></td>
                        <td><?php echo $fetch_message['message'];?></td>
                        <td><a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete">delete</a></td>
                                    
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