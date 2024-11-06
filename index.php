<?php
include 'blogFunction.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['seedBlog'])) {
        seedBlog();
    } elseif (isset($_POST['deleteBlog'])) {
        deleteBlog($_POST['blogId']);
    } elseif (isset($_POST['editBlog'])) {
        editBlog($_POST['blogId'], $_POST['title'], $_POST['content']);
    }
}
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
    <title>Gerry's Blogging Area</title>
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
        if (isLoggedIn()) {
            echo "<p>Welcome, " . $_SESSION['username'] . "!</p>";
        } else {
            echo "<p>You are not logged in.</p>";
        }
        showBlog();
        ?>
        <br><br>
        <?php if (isLoggedIn()): ?>
            <form method="post" action="">
                <button type="submit" name="seedBlog">Seed Blog</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>