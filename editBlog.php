<?php
include 'blogFunction.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editBlog'])) {
    $blogId = $_POST['blogId'];
    $blog = getBlogById($blogId);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateBlog'])) {
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $imagePath = uploadImage($_FILES['image']);
    }
    editBlog($_POST['blogId'], $_POST['title'], $_POST['content'], $imagePath);
    header('Location: index.php');
    exit();
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
    <title>Edit Blog</title>
</head>
<body>
    <div class="NavBar">
        <div class="Title">
            Gerry's Blogging Area
        </div>
        <div class="Menu">
            <a href="index.php">Home</a>
            <a href="readBlog.php">Read</a>
            <a href="writeBlog.php">Write</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="Content center-content">
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="blogId" value="<?php echo $blog['id']; ?>">
            <input type="text" name="title" value="<?php echo $blog['title']; ?>" required>
            <textarea name="content" required><?php echo $blog['content']; ?></textarea>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="updateBlog">Update Blog</button>
        </form>
    </div>
</body>
</html>