<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied!");
}

/* ================= INPUTS ================= */
$banner_text = $_POST['banner_text'];
$banner_subtitle = $_POST['banner_subtitle'];
$header_color = $_POST['header_color'];
$font_size = $_POST['font_size'];
$font_style = $_POST['font_style'];

/* ================= CURRENT DATA ================= */
$settings = $conn->query("SELECT * FROM settings WHERE id=1")->fetch_assoc();

/* ================= LOGO UPLOAD ================= */
$logo = $settings['logo'];

if (!empty($_FILES['logo']['name'])) {
    $logo_name = time() . "_logo_" . $_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "uploads/" . $logo_name);
    $logo = $logo_name;
}

/* ================= BACKGROUND UPLOAD ================= */
$banner_background = $settings['banner_background'];

if (!empty($_FILES['banner_background']['name'])) {
    $bg_name = time() . "_bg_" . $_FILES['banner_background']['name'];
    move_uploaded_file($_FILES['banner_background']['tmp_name'], "uploads/" . $bg_name);
    $banner_background = $bg_name;
}

/* ================= UPDATE DATABASE ================= */
$conn->query("
UPDATE settings SET
banner_text='$banner_text',
banner_subtitle='$banner_subtitle',
header_color='$header_color',
font_size='$font_size',
font_style='$font_style',
logo='$logo',
banner_background='$banner_background'
WHERE id=1
");

header("Location: settings.php?success=1");
exit();