<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pweb-blog";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function seedBlog() {
    global $conn;
    $sql = "INSERT INTO blogs (title, content) VALUES ('Test Blog', 'This is a test blog')";
    $conn->query($sql);
}

function createBlog($title, $content, $image) {
    global $conn;
    $imagePath = uploadImage($image);
    $sql = "INSERT INTO blogs (title, content, image) VALUES ('$title', '$content', '$imagePath')";
    $conn->query($sql);
}

function editBlog($id, $title, $content, $image = null) {
    global $conn;
    $sql = "UPDATE blogs SET title='$title', content='$content'";
    $sql .= " WHERE id=$id";
    $conn->query($sql);
}

function deleteBlog($id) {
    global $conn;
    $sql = "DELETE FROM blogs WHERE id=$id";
    $conn->query($sql);
}

function showBlog() {
    $blogs = getBlogs();
    if (count($blogs) > 0) {
        foreach ($blogs as $row) {
            echo "<div class='BlogWrapper'>";
            echo "<div class='BlogTitle'>" . $row["title"] . "</div>";
            echo "<div class='BlogContent'>" . $row["content"] . "</div>";
            if ($row["image"]) {
                echo "<img src='" . $row["image"] . "' alt='Blog Image' class='BlogImage'>";
            }
            if (isLoggedIn()) {
                echo "<form method='post' action='' class='blog-action-form'>";
                echo "<input type='hidden' name='blogId' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='deleteBlog'>Delete</button>";
                echo "</form>";
                echo "<form method='post' action='editBlog.php' class='blog-action-form'>";
                echo "<input type='hidden' name='blogId' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='editBlog'>Edit</button>";
                echo "</form>";
            }
            echo "</div>";
        }
    } else {
        echo "No blogs found.";
    }
}

function uploadImage($file) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $targetFile = $targetDir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        return null;
    }
}

function getBlogs() {
    global $conn;
    $sql = "SELECT * FROM blogs";
    $result = $conn->query($sql);
    $blogs = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
    }
    return $blogs;
}

function getBlogById($id) {
    global $conn;
    $sql = "SELECT * FROM blogs WHERE id=$id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function registerUser($username, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    $conn->query($sql);
}

function loginUser($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 30 days
            return true;
        }
    }
    return false;
}

function logoutUser() {
    session_unset();
    session_destroy();
    setcookie('user_id', '', time() - 3600, "/");
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) || isset($_COOKIE['user_id']);
}
?>