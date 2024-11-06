<?php
include 'blogFunction.php';
header('Content-Type: application/json');
$blogs = getBlogs();
echo json_encode($blogs);
?>