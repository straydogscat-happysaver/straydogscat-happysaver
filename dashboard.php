<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "header.php";
include "navbar.php";

/* =========================
   ROLE CHECK
========================= */
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

/* =========================
   COUNTS
========================= */
$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$posts = $conn->query("SELECT COUNT(*) as total FROM posts")->fetch_assoc()['total'];
$pets = $conn->query("SELECT COUNT(*) as total FROM pets")->fetch_assoc()['total'];
$adoptions = $conn->query("SELECT COUNT(*) as total FROM adoptions")->fetch_assoc()['total'];

/* =========================
   LATEST DATA
========================= */
$latest_posts = $conn->query("
    SELECT posts.*, users.name 
    FROM posts 
    LEFT JOIN users ON posts.user_id = users.id 
    ORDER BY posts.id DESC LIMIT 5
");

$latest_pets = $conn->query("
    SELECT * FROM pets ORDER BY id DESC LIMIT 5
");

$latest_adoptions = $conn->query("
    SELECT adoptions.*, users.name 
    FROM adoptions 
    LEFT JOIN users ON adoptions.user_id = users.id 
    ORDER BY adoptions.id DESC LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f6fa;
}

.card-box{
    border-radius:15px;
    padding:20px;
    color:#fff;
    transition:0.2s;
}

.card-box:hover{
    transform:translateY(-3px);
}

.bg-users{background:#3498db;}
.bg-posts{background:#2ecc71;}
.bg-pets{background:#f39c12;}
.bg-adopt{background:#9b59b6;}

.section-box{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.05);
    margin-bottom:20px;
}
</style>

</head>
<body>

<div class="container mt-4">

    <h2>
        📊 Dashboard Overview
        <span class="badge bg-<?= $is_admin ? 'danger' : 'primary' ?>">
            <?= strtoupper($_SESSION['role']) ?>
        </span>
    </h2>

    <!-- STATS -->
    <div class="row mt-3">

        <!-- USERS (ADMIN ONLY) -->
        <?php if ($is_admin) { ?>
        <div class="col-md-3">
            <div class="card-box bg-users">
                <h4>Users</h4>
                <h2><?= $users ?></h2>
            </div>
        </div>
        <?php } ?>

        <div class="col-md-3">
            <div class="card-box bg-posts">
                <h4>Posts</h4>
                <h2><?= $posts ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box bg-pets">
                <h4>Pets</h4>
                <h2><?= $pets ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box bg-adopt">
                <h4>Adoptions</h4>
                <h2><?= $adoptions ?></h2>
            </div>
        </div>

    </div>

    <!-- LATEST POSTS -->
    <div class="section-box mt-4">

        <h4>📰 Latest Posts</h4>

        <?php while($row = $latest_posts->fetch_assoc()){ ?>
            <p>
                <b><?= htmlspecialchars($row['title']) ?></b><br>
                <small>by <?= htmlspecialchars($row['name'] ?? 'Unknown') ?></small>
            </p>
            <hr>
        <?php } ?>

    </div>

    <!-- LATEST PETS -->
    <div class="section-box">

        <h4>🐶 Latest Pets</h4>

        <?php while($row = $latest_pets->fetch_assoc()){ ?>
            <p>
                <b><?= htmlspecialchars($row['title']) ?></b><br>
                <small>Status: <?= htmlspecialchars($row['status']) ?></small>
            </p>
            <hr>
        <?php } ?>

    </div>

    <!-- LATEST ADOPTIONS -->
    <div class="section-box">

        <h4>🐾 Latest Adoptions</h4>

        <?php while($row = $latest_adoptions->fetch_assoc()){ ?>
            <p>
                <b><?= htmlspecialchars($row['pet_name']) ?></b><br>
                <small>Contact: <?= htmlspecialchars($row['contact']) ?></small>
            </p>
            <hr>
        <?php } ?>

    </div>

</div>

</body>
</html>
