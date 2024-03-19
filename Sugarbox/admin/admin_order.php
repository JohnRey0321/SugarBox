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

    //DELETE PRODUCTS FROM DATABASE
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        
        mysqli_query($conn, "DELETE FROM `order` WHERE id = '$delete_id'") or die ('query failed');
        $message[] = 'deleted succesfully';
        header('location:admin_order.php');
    }

    //UPDATING PAYMENT STATUS
    if (isset($_POST['update_order'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];
        $message[] = 'updated succesfully';
        mysqli_query($conn, "UPDATE `order` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die ('query failed');
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

        <section class="order-container">
            <h1 class="title">Total order</h1>

            
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
            <div class="box-container">
                <?php
                
                $select_orders = mysqli_query($conn, "SELECT * FROM `order` ORDER BY `order`.`id` DESC") or die ('query failed');
                if (mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                 
                ?>

                <div class="box">
                        <p>user name: <span><?php echo $fetch_orders['name'];?></spsan></p>
                        <p>user id: <span><?php echo $fetch_orders['id'];?></span></p>
                        <p>placed on: <span><?php echo $fetch_orders['placed_on'];?></span></p>
                        <p>number: <span><?php echo $fetch_orders['number'];?></span></p>
                        <p>email: <span><?php echo $fetch_orders['email'];?></span></p>
                        <p>total price: <span><?php echo $fetch_orders['total_price'];?></span></p>
                        <p>method: <span><?php echo $fetch_orders['method'];?></span></p>
                        <p>address: <span><?php echo $fetch_orders['address'];?></span></p>
                        <p>total product: <span><?php echo $fetch_orders['total_products'];?></span></p>
                        
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option disable selected><?php echo $fetch_orders['payment_status']; ?></option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                
                            </select>
                            <input type="submit" name="update_order" value="update" class="btn-1">
                            <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="btn-1">delete</a>
                            </form>
                </div>

                <?php    
                             }
                            }else{
                                echo '
                                <div class="empty">
                            <p>no orders placed yet!</p>
                        </div>
                                ';
                         
                        }       
                        ?>
            </div>
        </section>

                <!--============ DATA INVENTORY SECTION ==============-->
    <section class="dashboard">
        <h1 class="result">RECENT PURCHASE</h1>
            <div class="scroll-table">
                <table class="table table-hover">
                <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
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
                        <td><?php echo $fetch_orders['number'];?></td>
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
                
    <div class="line"></div>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>