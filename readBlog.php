<?php
include 'blogFunction.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Read Blog</title>
</head>
<body>
    <div class="NavBar">
        <div class="Title">
            Gerry's Blogging Area
        </div>
        <div class="Menu">
            <a href="index.php">Home</a>
            <a href="readBlog.php">Read</a>
            <?php if (isLoggedIn()): ?>
                <a href="writeBlog.php">Write</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="Content top-content">
        <?php 
            showBlog();
        ?>
    </div>
</body>
</html>