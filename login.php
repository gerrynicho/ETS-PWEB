<?php
include 'blogFunction.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (loginUser($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        setcookie('username', $_POST['username'], time() + (86400 * 30), "/"); // Set cookie for 30 days
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password.";
        error_log($error);
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
    <title>Login</title>
</head>
<body>
    <div class="NavBar">
        <div class="Title">
            Gerry's Blogging Area
        </div>
        <div class="Menu">
            <a href="index.php">Home</a>
            <a href="readBlog.php">Read</a>
            <a href="register.php">Register</a>
        </div>
    </div>
    <div class="Content center-content">
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>