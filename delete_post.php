<?php
session_start();
include "db.php";

/* =========================
   ADMIN ONLY ACCESS
========================= */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

/* =========================
   VALIDATE ID
========================= */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$post_id = intval($_GET['id']);

/* =========================
   DELETE POST
========================= */
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    header("Location: posts.php?deleted=1");
    exit();
} else {
    echo "Error deleting post.";
}
?>