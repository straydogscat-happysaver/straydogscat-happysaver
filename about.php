<?php
session_start();
include "header.php";
include "db.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>About Us</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
}

.about-container {
    max-width: 900px;
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.title {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.subtitle {
    text-align: center;
    color: gray;
    margin-bottom: 20px;
}

.highlight {
    font-weight: bold;
    color: #0d6efd;
}

.section-title {
    margin-top: 20px;
    font-weight: bold;
    font-size: 18px;
}
</style>

</head>

<body>

<div class="container mt-4">

<div class="about-container">

    <!-- TITLE -->
    <div class="title">
        Welcome to Your Community Pet & Tourism Portal
    </div>

    <div class="subtitle">
        RESCUE • CARE • PROTECT • CONNECT
    </div>

    <hr>

    <!-- CONTENT -->
    <p>
        This platform was created with a strong mission: to help rescue, protect, and care for stray dogs and cats.
        It is designed not only for Zamboanguita but for all communities around the world who can access this system.
    </p>

    <p>
        Stray animals are often seen wandering streets without shelter, food, or medical care. Many are abandoned pets,
        while others are born into hardship. They struggle every day to survive, facing hunger, sickness, injury, and danger.
    </p>

    <p>
        This website serves as a bridge between people who care and animals in need of help. Through community reporting,
        we can locate stray animals and respond quickly for rescue and assistance.
    </p>

    <div class="section-title">🐾 Our Mission</div>
    <p>
        To <span class="highlight">rescue, protect, and improve the lives of stray dogs and cats</span> through community
        involvement, awareness, and action.
    </p>

    <div class="section-title">🌍 Our Vision</div>
    <p>
        A world where every stray dog and cat has the chance to be rescued, cared for, and given a loving home.
    </p>

    <div class="section-title">❤️ Why This Matters</div>
    <p>
        Animals cannot speak for themselves. They depend on humans for survival. By working together as a community,
        we can reduce suffering, prevent cruelty, and create safer environments for both people and animals.
    </p>

    <p>
        This platform encourages reporting of stray pets, adoption of rescued animals, and participation in
        awareness programs that promote responsible pet ownership.
    </p>

    <div class="section-title">🐶🐱 Final Message</div>
    <p class="text-center fw-bold text-primary">
        RESCUE • CARE • PROTECT • CONNECT
    </p>

    <p class="text-center">
        Every life matters. Every action counts. Every rescue brings hope.
    </p>

</div>

</div>

</body>
</html>