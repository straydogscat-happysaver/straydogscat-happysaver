<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

$settings = $conn->query("SELECT * FROM settings WHERE id=1")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
    font-family: <?= $settings['font_style'] ?? 'Arial' ?>;
    font-size: <?= $settings['font_size'] ?? '16px' ?>;
}

.card {
    border: none;
    border-radius: 12px;
}

.preview {
    width: 140px;
    height: 90px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #ddd;
}
</style>

</head>

<body>

<div class="container mt-4">

<div class="card p-4 shadow-sm">

<h4>⚙️ System Settings</h4>

<form action="settings_save.php" method="POST" enctype="multipart/form-data">

<!-- ================= BANNER ================= -->
<label>Main Banner Text</label>
<input type="text" name="banner_text" class="form-control mb-2"
       value="<?= htmlspecialchars($settings['banner_text'] ?? '') ?>">

<label>Banner Subtitle</label>
<input type="text" name="banner_subtitle" class="form-control mb-3"
       value="<?= htmlspecialchars($settings['banner_subtitle'] ?? '') ?>">

<hr>

<!-- ================= BACKGROUND IMAGE ================= -->
<label>Banner Background Image</label><br>

<?php if (!empty($settings['banner_background'])) { ?>
    <img src="uploads/<?= $settings['banner_background'] ?>" class="preview mb-2">
<?php } ?>

<input type="file" name="banner_background" class="form-control mb-3">

<hr>

<!-- ================= LOGO ================= -->
<label>Logo</label><br>

<?php if (!empty($settings['logo'])) { ?>
    <img src="uploads/<?= $settings['logo'] ?>" class="preview mb-2">
<?php } ?>

<input type="file" name="logo" class="form-control mb-3">

<hr>

<!-- ================= THEME ================= -->
<label>Header Color</label>
<input type="color" name="header_color" class="form-control mb-2"
       value="<?= $settings['header_color'] ?? '#0d6efd' ?>">

<label>Font Size</label>
<select name="font_size" class="form-control mb-2">
    <option value="14px" <?= ($settings['font_size'] ?? '')=='14px'?'selected':'' ?>>Small</option>
    <option value="16px" <?= ($settings['font_size'] ?? '')=='16px'?'selected':'' ?>>Normal</option>
    <option value="18px" <?= ($settings['font_size'] ?? '')=='18px'?'selected':'' ?>>Large</option>
</select>

<label>Font Style</label>
<select name="font_style" class="form-control mb-3">
    <option value="Arial">Arial</option>
    <option value="Roboto">Roboto</option>
    <option value="Georgia">Georgia</option>
    <option value="Courier New">Courier New</option>
</select>

<button class="btn btn-primary">
    <i class="bi bi-save"></i> Save Settings
</button>

</form>

</div>

</div>

</body>
</html>