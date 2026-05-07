<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "db.php";

/* =========================
   LOAD SETTINGS
========================= */
$settings = $conn->query("SELECT * FROM settings WHERE id=1")->fetch_assoc() ?? [];

$banner_text = $settings['banner_text'] ?? "Zamboanguita Hub";
$banner_subtitle = $settings['banner_subtitle'] ?? "Welcome to Community Portal";

$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<style>

/* ================= HEADER BACKGROUND ================= */
.header-bar {
    position: relative;
    color: white;
    padding: 18px 20px;

    background-image: url('uploads/<?= $settings['banner_background'] ?? 'default.jpg' ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    min-height: 140px;
}

/* DARK OVERLAY */
.header-bar::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    z-index: 1;
}

/* CONTENT ABOVE OVERLAY */
.header-container {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* LEFT SECTION */
.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-left img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.header-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.header-sub {
    font-size: 12px;
    opacity: 0.9;
}

/* USER BOX */
.user-box {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 5px 10px;
    border-radius: 20px;
    background: rgba(255,255,255,0.15);
}

.role-badge {
    font-size: 10px;
    padding: 3px 7px;
    border-radius: 10px;
}

/* NAV LINKS */
.nav-link {
    border-radius: 10px;
    transition: 0.2s;
}

.nav-link:hover {
    background: rgba(255,255,255,0.1);
}

/* MOBILE */
@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .header-left {
        justify-content: center;
    }
}

</style>

<!-- ================= HEADER ================= -->
<div class="header-bar">

    <div class="container header-container">

        <!-- LEFT -->
        <div class="header-left">

            <img src="<?= !empty($settings['logo']) ? 'uploads/'.$settings['logo'] : 'assets/default-logo.png' ?>">

            <div>
                <div class="header-title">
                    <?= htmlspecialchars($banner_text) ?>
                </div>

                <div class="header-sub">
                    <?= htmlspecialchars($banner_subtitle) ?>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="text-end small">
            <i class="bi bi-geo-alt-fill"></i> LGU Portal System
        </div>

    </div>
</div>


            <!-- RIGHT USER -->
            <ul class="navbar-nav ms-auto align-items-center">

                <?php if (!empty($_SESSION['user'])) { ?>

                <li class="nav-item me-2">
                    <div class="user-box text-light">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['user']) ?>

                        <?php if (!empty($_SESSION['role'])) { ?>
                            <span class="role-badge bg-<?= $is_admin ? 'danger' : 'primary' ?>">
                                <?= strtoupper($_SESSION['role']) ?>
                            </span>
                        <?php } ?>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-1 px-3"
                       href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
                </li>

                <?php } ?>

            </ul>

        </div>
    </div>
</nav>