<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$stmt = $conn->prepare("
    UPDATE users 
    SET name=?, email=?, role=? 
    WHERE id=?
");

$stmt->bind_param("sssi", $name, $email, $role, $id);
$stmt->execute();

header("Location: settings.php?updated=1");
exit();