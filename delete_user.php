<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

$id = $_GET['id'] ?? 0;

// prevent deleting yourself (optional safety)
if ($id == $_SESSION['user_id']) {
    die("You cannot delete your own account!");
}

$conn->query("DELETE FROM users WHERE id=$id");

header("Location: settings.php?deleted=1");
exit();