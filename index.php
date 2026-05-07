<?php
session_start();
include "db.php";
include "navbar.php";

// load settings (for background fallback if needed)
$settings = $conn->query("SELECT * FROM settings WHERE id=1")->fetch_assoc();

$background = !empty($settings['background']) ? "uploads/" . $settings['background'] : "";
?>

<!DOCTYPE html>
<html>
<head>
<title><?= htmlspecialchars($settings['banner_text'] ?? 'Zamboanguita Hub') ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
body {
    <?php if ($background) { ?>
        background-image: url('<?= $background ?>');
        background-size: cover;
        background-attachment: fixed;
    <?php } else { ?>
        background: #f4f6f9;
    <?php } ?>
}

.overlay {
    background: rgba(255,255,255,0.92);
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
}

.card-box {
    border: none;
    border-radius: 12px;
}
</style>

</head>

<body>

<div class="container mt-4">

<!-- WELCOME BOX -->
<div class="overlay shadow-sm mb-3">

    <h4>
        👋 Welcome, 
        <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : "Guest" ?>
    </h4>

    <p class="text-muted mb-0">
        🐾 Zamboanguita Stray Community System Dashboard
    </p>

</div>

<!-- QUICK STATS (OPTIONAL FUTURE EXTENSION) -->
<div class="row mb-3">

    <div class="col-md-4">
        <div class="card card-box shadow-sm p-3 text-center">
            <h5>🐶 Pets</h5>
            <p class="text-muted">Community reports</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box shadow-sm p-3 text-center">
            <h5>📝 Posts</h5>
            <p class="text-muted">Latest updates</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box shadow-sm p-3 text-center">
            <h5>📍 Reports</h5>
            <p class="text-muted">Stray locations</p>
        </div>
    </div>

</div>

<!-- LIVE FEED -->
<div class="overlay shadow-sm">

    <h5 class="mb-3">📢 Latest Posts</h5>

    <div id="feed">Loading posts...</div>

</div>

</div>

<script>
function loadPosts(){
    $.get("posts_fetch.php", function(data){
        $("#feed").html(data);
    });
}

loadPosts();
setInterval(loadPosts, 5000);
</script>

</body>
</html>