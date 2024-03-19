<?php 
include '../db.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)){
    header('location:../login.php');
}
if (!isset($user_name)){
    header('location:../login.php');
}
if (isset($_POST['logout'])){
    session_destroy();
    header('location:../home.php');
}

// Function to start a conversation without specifying a name
if (isset($_POST['start-conversation'])){
    $conversation_name = $user_name; // Using user's name for the conversation
    // Check if conversation already exists
    $check_conversation = mysqli_query($conn, "SELECT * FROM `user_message` WHERE name='$conversation_name' AND user_id='$user_id'");
    if (mysqli_num_rows($check_conversation) > 0) {
        $message[] = 'Conversation already exists';
    } else {
        // Start the conversation
        mysqli_query($conn, "INSERT INTO `user_message` (`name`, `user_id`) VALUES ('$conversation_name', '$user_id')") or die ('query failed');
        $message[] = 'Conversation started';
    }
}

if (isset($_POST['submit-btn'])){
    $name = $user_name; 
    $message_text = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name='$name' AND message='$message_text'") or die ('query failed');
    if (mysqli_num_rows($select_message) > 0){
        $message[] = 'Message already sent';
    } else {
        mysqli_query($conn, "INSERT INTO `message` (`name`, `message`, `user_id`) VALUES('$name', '$message_text', '$user_id')") or die ('query failed');
    }
}

// DELETE CONVERSATION FROM DATABASE
if (isset($_GET['delete'])){
    $delete_conversation_name = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `user_message` WHERE name = '$delete_conversation_name'") or die ('query failed');
    header('location:message.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== BOOTSTRAP ICON LINK ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!-- Custom CSS for message display -->
    <style>
        .message-container {
            max-width: 600px;
            margin: auto;
        }
        .message {
            margin-bottom: 10px;
        }
        .sent-message {
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
        .received-message {
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto; /* Allow chat messages to scroll */
            padding: 1rem; /* Add padding to separate messages from input */
        }
    </style>

    <title>SugarBox - Message</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Chat with us</h1>
            <a href="index.php">HOME/</a><span> MESSAGE</span>
        </div>
    </div>

    <section class="product-display">
        <h1 class="result">MESSAGE</h1>
        <div class="scroll-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    $select_message = mysqli_query($conn, "SELECT DISTINCT name FROM `user_message` WHERE user_id = '$user_id' ORDER BY `user_message`.`message` DESC   ") or die ('query failed');
                    if (mysqli_num_rows($select_message) > 0){
                        while($fetch_message = mysqli_fetch_assoc($select_message)){
                ?>
                    <tr>
                        <td><?php echo $fetch_message['name'];?></td>
                        <td>
                            <a href="message.php?chat=<?php echo $fetch_message['name']; ?>" class="chat bi bi-reply-fill">View Conversation</a>
                        </td>               
                    </tr>
                <?php 
                        }
                    } else {
                        echo '<div class="empty"><p>no message!</p></div>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Start conversation button -->
    <div class="start-conversation">
        <form method="post">
            <?php if (!empty($message)) { ?>
                <div class="message">
                    <?php foreach($message as $msg) { ?>
                        <span><?php echo $msg; ?></span>
                    <?php } ?>
                </div>
            <?php } ?>
            <button type="submit" name="start-conversation" class="chat">Start Conversation</button>
        </form>
    </div>
    
    <!-- Conversation container -->
    <?php
    if (isset($_GET['chat'])) {
        $message_name = $_GET['chat'];
        $message_query_admin = mysqli_query($conn, "SELECT * FROM `user_message` WHERE user_id='$user_id' AND name='$message_name'") or die ('query failed');
        $message_query_user = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id='$user_id'") or die ('query failed');

        if (mysqli_num_rows($message_query_admin) > 0 || mysqli_num_rows($message_query_user) > 0 ){
    ?>
        <div class="message-container">
            <div class="chat-messages">
                <i class="fa-solid fa-x" id="close-form"></i>
                <h1 class="title">SugarBox</h1>
                <p>Conversation with <?php echo $message_name; ?></p>
                <?php  
                if (!empty($message)) {
                    foreach($message as $msg) {
                        echo '<div class="message"><span>'.$msg.'</span><i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i></div>';      
                    }
                }

                while ($fetch_mess_admin = mysqli_fetch_assoc($message_query_admin)) {
                ?>
                    <div class="convo received-message">
                        <p><?php echo $fetch_mess_admin['name']; ?>:</p>
                        <h5><?php echo $fetch_mess_admin['message']; ?></h5>
                    </div>
                <?php
                }
                
                while ($fetch_mess_user = mysqli_fetch_assoc($message_query_user)) {
                ?>
                    <div class="convo-user sent-message">
                        <p>You:</p>
                        <h5><?php echo $fetch_mess_user['message']; ?></h5>
                    </div>
                    
                <?php
                }
                ?>
            </div>
            <form method="post">
                <!--================ SUBMIT BTN ===================-->
                <div class="input-field">
                    <textarea name="message" placeholder="Type here..." required></textarea>
                    <button type="submit" name="submit-btn" class="message-btn bi bi-send"> </button>
                </div>
            </form>
        </div>
    <?php
        }
    }
    echo "<script>document.querySelector('.message-container').style.display='block'</script>";
    ?>

    <?php include 'footer.php'; ?>

    <!--=============== SCRIPT JS ===================-->
    <script type="text/javascript" src="../js/script2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>