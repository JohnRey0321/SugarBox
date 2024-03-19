<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
    exit(); // Stop further execution
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// HANDLE ORDER PLACEMENT
if (isset($_POST['order-btn'])) {
    // Sanitize user input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['barangay'] . ', ' . $_POST['city']);
    
    // RETRIEVE USER'S CART ITEM
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die ('Cart query failed');
    $total_price = 0;
    $total_products = array();
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {
        $total_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ')';
        $total_price += $cart_item['price'] * $cart_item['quantity'];
        
        // Subtract quantity from product stock
        $product_id = $cart_item['pid'];
        $quantity = $cart_item['quantity'];
        mysqli_query($conn, "UPDATE `products` SET stock = stock - $quantity WHERE id = $product_id") or die('Update stock query failed');
    }
    
    // INSERT ORDER DETAILS IN DATABASE
    $placed_on = date('Y-m-d');
    $total_products_str = implode(', ', $total_products);
    $insert_order_query = "INSERT INTO `order` (`user_id`, `name`, `number`, `method`, `address`, `total_products`, `total_price`, `placed_on`) VALUES ('$user_id', '$name', '$number', '$method', '$address', '$total_products_str', '$total_price', '$placed_on')";
    if (mysqli_query($conn, $insert_order_query)) {
        // Order placed successfully, delete items from cart
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'");
        $message = 'Order placed successfully';
    } else {
        $error_message = 'Failed to place order';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Banner -->
    <div class="banner">
        <div class="detail">
            <h1>Checkout</h1>
            <p>"Crafted Cravings: Your One-Stop Dessert Destination".</p>
            <a href="index.php">HOME/</a><span> CHECKOUT</span>
        </div>
    </div>

    <!-- Checkout Form -->
    <div class="checkout-form">
        <h1 class="title">Payment Process</h1>
        <?php if (isset($message)) : ?>
            <div class="message">
                <span><?= $message ?></span>
            </div>
        <?php endif; ?>
        <?php if (isset($error_message)) : ?>
            <div class="message">
                <span><?= $error_message ?></span>
            </div>
        <?php endif; ?>

        <!-- Display Order -->
        <div class="display-order">
            <div class="box-container">
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die ('Cart query failed');
                $grand_total = 0;
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) :
                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total += $total_price;
                ?>
                    <div class="box">
                        <img src="../admin/image/<?= $fetch_cart['image']; ?>">
                        <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    </div>
                <?php endwhile; ?>
            </div>
            <span class="grand-total">Total Amount Payable: ₱ <?= $grand_total; ?> /-</span>
            <p>Note: Please fill out delivery information below!</p>
        </div>

        <!-- Order Form -->
        <form method="post">
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="input-field">
                <label>Your Number</label>
                <input type="number" name="number" placeholder="Enter your number" required>
            </div>
            <div class="input-field">
                <label>Select Payment Method</label>
                <select name="method" required>
                    <option value="" selected disabled>Select payment method</option>
                    <option value="Cash on Delivery">Cash on Delivery (COD)</option>
                    <option value="Cash on Pickup">Cash on Pickup (COP)</option>
                </select>
            </div>
            <div class="input-field">
                <label>Barangay</label>
                <input type="text" name="barangay" placeholder="e.g. Poblacion" required>
            </div>
            <div class="input-field">
                <label>Municipality/City</label>
                <input type="text" name="city" placeholder="e.g. Manjuyod" required>
            </div>
            <input type="submit" name="order-btn" class="btn" value="Order Now">
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
