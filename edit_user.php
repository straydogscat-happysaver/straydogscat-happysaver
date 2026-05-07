<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

$id = $_GET['id'] ?? 0;

$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if (!$user) {
    die("User not found!");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h3>✏️ Edit User</h3>

<form action="update_user.php" method="POST">

    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label>Name</label>
    <input type="text" name="name" class="form-control mb-2"
           value="<?= htmlspecialchars($user['name']) ?>">

    <label>Email</label>
    <input type="email" name="email" class="form-control mb-2"
           value="<?= htmlspecialchars($user['email']) ?>">

    <label>Role</label>
    <select name="role" class="form-control mb-3">
        <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
    </select>

    <button class="btn btn-primary">
        Save Changes
    </button>

    <a href="settings.php" class="btn btn-secondary">Back</a>

</form>

</body>
</html>